<!DOCTYPE html>
<html x-data="data" lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="inputmask" content="{{ blink()->mask() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('admin_assets/css/app.css') }}">

        <!-- Scripts -->
        <script type="text/javascript" src="{{ asset('admin_assets/js/app.js') }}" defer></script>
        <script type="text/javascript" src="{{ asset('admin_assets/js/init-alpine.js') }}"></script>
</head>
<body>
<div
    class="flex h-screen bg-gray-50"
    :class="{ 'overflow-hidden': isSideMenuOpen }"
>
    <!-- Desktop sidebar -->
    @include('admin.layouts.navigation')
    <!-- Mobile sidebar -->
    <!-- Backdrop -->
    @include('admin.layouts.navigation-mobile')
    <div class="flex flex-col flex-1 w-full">
        @include('admin.layouts.top-menu')
        <main class="h-full overflow-y-auto">
            <div class="container px-6 mx-auto grid">
                <h2 class="my-6 text-2xl font-semibold text-gray-700">
                    {{ $header }}
                </h2>

                @if(session()->has('message'))
                    <div class="py-5" x-data="{openAlert: true}" x-show="openAlert">
                        <div class="flex items-center text-white text-sm font-bold px-4 py-3 rounded shadow-md bg-green-500" role="alert">
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-2 text-white"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ session()->get('message') }}
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 ml-auto" @click="openAlert = false"><path d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                    </div>
                @endif

                {{ $slot }}
            </div>
        </main>
    </div>
</div>
</body>
</html>
