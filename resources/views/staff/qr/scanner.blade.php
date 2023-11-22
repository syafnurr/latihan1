@extends('staff.layouts.default')

@section('page_title', trans('common.scan_qr') . config('default.page_title_delimiter') . trans('common.dashboard') . config('default.page_title_delimiter') . config('default.app_name'))

@section('content')
<section class="bg-gray-50 dark:bg-gray-900 w-full">
    <div class="py-8 px-4 mx-auto sm:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-16">

            <x-ui.button
                class="scan-qr disable-on-scan mb-6"
                :text="trans('common.scan_qr')"
                icon="qr-code"
            />

            <div id="code-found"
                class="hidden z-40 flex items-center w-full p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                role="alert">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ml-3 text-sm font-normal">{{ trans('common.code_found') }}</div>
            </div>

            <video id="video" class="w-full rounded-md"></video>
        </div>
    </div>
</section>

<script>
window.onload = function() {
    const codeFound = document.getElementById('code-found');

    // Listen to the pageshow event
    window.addEventListener('pageshow', function(event) {
        // If the page is loaded from the cache (like when using the back button)
        if (event.persisted) {
            // Hide the codeFound element
            codeFound.classList.add('hidden');
        }
    });
};
</script>
@stop