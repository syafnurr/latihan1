<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Partner\ForgotPasswordRequest;
use App\Http\Requests\Partner\LoginLinkRequest;
use App\Http\Requests\Partner\LoginRequest;
use App\Http\Requests\Partner\ResetPasswordRequest;
use App\Services\Partner\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{
    /**
     * Display the login view or redirect to the partner index page if already logged in.
     *
     * @param Request $request The incoming request instance.
     * @return View|RedirectResponse Returns the login view or a redirect response to the partner index.
     */
    public function login(Request $request): View|RedirectResponse
    {
        // Retrieve email and password from the request, default to null if not present
        $email = $request->get('e', null);
        $password = $request->get('p', null);
        
        // If both email and password are present, decrypt them
        if ($email && $password) {
            $email = Crypt::decryptString($email);
            $password = Crypt::decryptString($password);
        }
        
        // Check if the partner user is already authenticated
        if (auth()->guard('partner')->check()) {
            // Retrieve the intended URL from the session
            $intendedUrl = session('url.intended');
            
            // Parse the intended URL to extract the path
            $segments = parse_url($intendedUrl, PHP_URL_PATH);
            
            // Split the path into its segments
            $parts = explode('/', trim($segments, '/'));
        
            // Check if the second segment of the intended URL is not 'partner'
            if (isset($parts[1]) && $parts[1] !== 'partner') {
                // If not 'partner', redirect to the partner index page
                return redirect()->route('partner.index');
            }
        
            // If 'partner', proceed with the intended redirect
            return redirect()->intended(route('partner.index'));
        }
        
        // If not authenticated, display the login view with the decrypted email and password
        return view('partner.auth.login', compact('email', 'password'));
    }

    /**
     * Authenticate the partner user and log them in.
     *
     * @param LoginRequest $request The incoming request instance containing login credentials.
     * @param AuthService $authService The authentication service instance.
     * @return RedirectResponse Returns a redirect response to the partner index or login page based on authentication success.
     */
    public function postLogin(LoginRequest $request, AuthService $authService): RedirectResponse
    {
        // Get validated request fields
        $input = $request->validated();
    
        // Attempt to authenticate the partner user using the AuthService
        $success = $authService->login($input);
    
        // Check if the authentication was successful
        if ($success) {
            // Retrieve the intended URL from the session
            $intendedUrl = session('url.intended');
            
            // Parse the intended URL to extract the path
            $segments = parse_url($intendedUrl, PHP_URL_PATH);
            
            // Split the path into its segments
            $parts = explode('/', trim($segments, '/'));
            
            // Check if the second segment of the intended URL is not 'partner'
            if (isset($parts[1]) && $parts[1] !== 'partner') {
                // If not 'partner', redirect to the partner index page
                return redirect()->route('partner.index');
            }
    
            // If 'partner', proceed with the intended redirect
            return redirect()->intended(route('partner.index'));
        }
    
        // If authentication was not successful, redirect back to the login page with an error message and preserve input (except password)
        return redirect()->route('partner.login')
                         ->with('error', trans('common.login_not_recognized'))
                         ->withInput($request->except('password'));
    
        // login link
        /*
        $authService->sendLoginLink($input);
    
        return view('partner.auth.link-sent', [
            'email' =>  $request->email
        ]);
        */
    }

    /**
     * Display the forgot password view or redirect to the partner index page if the user is already logged in.
     *
     * @param Request $request The incoming request instance.
     * @return View|RedirectResponse Returns the forgot password view or a redirect response to the partner index.
     */
    public function forgotPassword(Request $request): View|RedirectResponse
    {
        return (auth()->guard('partner')->check())
            ? redirect()->route('partner.index')
            : view('partner.auth.forgot-password');
    }

    /**
     * Send a password reset link to the user's email.
     *
     * @param ForgotPasswordRequest $request The incoming request instance containing the email.
     * @param AuthService $authService The authentication service instance.
     * @return RedirectResponse Returns a redirect response based on the success of sending the reset link.
     */
    public function postForgotPassword(ForgotPasswordRequest $request, AuthService $authService): RedirectResponse
    {
        // Get validated request fields
        $input = $request->validated();

        // Send reset link
        $success = $authService->sendResetPasswordLink($input['email']);

        return ($success)
            ? redirect()->route('partner.forgot_password')->with('success', trans('common.reset_link_has_been_sent_to_email', ['email' => '<u>'.$input['email'].'</u>']))
            : redirect()->route('partner.forgot_password')->with('error', trans('common.user_not_found'))->withInput();
    }

    /**
     * Display the reset password view or redirect to the partner index page if the user is already logged in.
     *
     * @param Request $request The incoming request instance.
     * @return View|RedirectResponse Returns the reset password view or a redirect response to the partner index.
     */
    public function resetPassword(Request $request): View|RedirectResponse
    {
        // Post reset link
        $postResetLink = URL::temporarySignedRoute(
            'partner.reset_password.post',
            now()->addMinutes(120),
            [
                'email' => $request->email,
            ]
        );

        return (auth()->guard('partner')->check())
            ? redirect()->route('partner.index')
            : view('partner.auth.reset-password', compact('postResetLink'));
    }

    /**
     * Update the user's password.
     *
     * @param ResetPasswordRequest $request The incoming request instance containing the new password.
     * @param AuthService $authService The authentication service instance.
     * @return RedirectResponse Returns a redirect response based on the success of the password update.
     */
    public function postResetPassword(ResetPasswordRequest $request, AuthService $authService): RedirectResponse
    {
        // Get validated request fields
        $input = $request->validated();

        // Send reset link
        $success = $authService->updatePassword($input['email'], $input['password']);

        return ($success)
            ? redirect()->route('partner.login')->with('success', trans('common.login_with_new_password'))->withInput(['email' => $input['email']])
            : redirect($request->getRequestUri())->with('error', trans('common.unknown_error'));
    }

    /**
     * Authenticate and log in a partner user using a login link.
     *
     * @param LoginLinkRequest $request The incoming request instance containing the email.
     * @param AuthService $authService The authentication service instance.
     * @return RedirectResponse Returns a redirect response based on the success of the login.
     */
    public function loginLink(LoginLinkRequest $request, AuthService $authService): RedirectResponse
    {
        if (! auth()->guard('partner')->check()) {
            $user = $authService->login($request->email);
        } else {
            $user = auth()->guard('partner')->user();
        }

        $redir = $request->intended;

        return $user
            ? redirect($redir)
            : redirect()->route('partner.login');
    }

    /**
     * Log out the currently authenticated partner user and redirect them to the login page.
     *
     * @param Request $request The incoming request instance.
     * @return RedirectResponse Returns a redirect response to the partner login page.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('partner')->logout();

        $request->session()->flash('success', trans('common.logout_success'));

        return redirect()->route('partner.login');
    }
}
