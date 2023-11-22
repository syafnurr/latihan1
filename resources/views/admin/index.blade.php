@extends('admin.layouts.default')

@section('page_title', ((auth('admin')->user()->role == 1) ? trans('common.administrator') : trans('common.manager')) . config('default.page_title_delimiter') . trans('common.dashboard') . config('default.page_title_delimiter') . config('default.app_name'))

@section('content')
<section class="bg-gray-50 dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto sm:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-md text-center mb-4 lg:mb-4">
        </div>

        <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-16">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">{{ trans('common.welcome_user', ['user' => (auth('admin')->user()->role == 1) ? trans('common.administrator') : trans('common.manager')]) }} {{ Arr::random(['😎', '🤠', '😊', '😃', '🙃', '🤩', '😉']) }}</h2>
            @if(auth('admin')->user()->role == 1)
            <p class="font-semibold text-gray-500 dark:text-gray-400 sm:text-xl mb-2">{!! trans('common.current_version_in_use', ['version' => '<span class="bg-yellow-100 text-yellow-800 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">' . config('version.current') . '</span>']) !!} @if($hasMigrations) <a href="{{ route('admin.migrate') }}" class="text-link underline">{{ trans('common.database_update') }}</a> @else {{ trans('common.database_up_to_date') }} @endif</p>
            @endif
            <p class="font-light text-gray-500 dark:text-gray-400 sm:text-xl">{!! (auth('admin')->user()->role == 1) ? trans('common.adminDashboardBlocksTitle') : trans('common.managerDashboardBlocksTitle') !!}</p>
        </div>

        <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 md:gap-8 xl:gap-8 md:space-y-0">
            @foreach($dashboardBlocks as $block)
            <a href="{{ $block['link'] }}" class="group block p-6 bg-white rounded shadow dark:bg-gray-800">
                <div class="flex justify-center items-center mb-4 w-10 h-10 rounded bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                    <x-ui.icon :icon="$block['icon']" class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300" />
                </div>
                <h3 class="mb-2 text-xl font-bold dark:text-white group-hover:underline">{!! $block['title'] !!}</h3>
                <p class="font-light text-gray-500 dark:text-gray-400">{!! $block['desc'] !!}</p>
            </a>
            @endforeach
        </div>
    </div>
</section>
@stop
