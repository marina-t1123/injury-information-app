<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- viteを使用するとBreezeでログイン画面のスタイルが崩れるので使用しない -->
        <!-- Scripts -->
        <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->

        <!-- viteを使用せず、app.cssとapp.jsを使用する -->
        <!-- styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js')}}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @if(request()->is('doctor*'))
                @include('layouts.doctor-navigation')
            @else
                @include('layouts.user-navigation')
            @endif

            <!-- Page Heading -->
            <header class="bg-white shadow flex-1">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- footer -->
            <footer class="text-gray-600 bottom-0 mt-5">
                <div class="container px-5 mx-auto flex items-center sm:flex-row flex-col">
                    <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">
                        <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">© 2022 Injury Information </font>
                        </font>
                        <a href="https://twitter.com/otk_m_1649" class="text-gray-600 ml-1" rel="noopener noreferrer" target="_blank">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">@otk_m_1649</font>
                        </font>
                        </a>
                    </p>
                    <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
                        <a href="https://twitter.com/otk_m_1649" class="ml-3 text-gray-500">
                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                        </svg>
                        </a>
                    </span>
                </div>
            </footer>
        </div>
    </body>
</html>
