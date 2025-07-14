<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Zintel Academy | CBT - Computer Based Test</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="
                https://cdn.jsdelivr.net/npm/sweetalert2/dist/sweetalert2.all.min.js
                "></script>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body class="bg-[#fcfcfd] dark:bg-[#0a0a0a] text-[#1b1b18] flex items-center lg:justify-center min-h-screen flex-col">
    <header class="w-full lg:max-w-full max-w-[100%] text-sm mb-6 not-has-[nav]:hidden ">

        @if (Route::has('login'))
            <nav>
                {{-- <header class="gap-3">
                    @auth

                        <a href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#ccc] text-[#fff] hover:bg-red-700 hover:border-[#32064a] dark:hover:border-[#3E3E3A] font-semibold text-l leading-normal rounded-md mx-3"
                            style="border:1px solid #fff">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC]  hover:bg-red-700 hover:border-[#32064a] text-[#fff] dark:border-[#3E3E3A] dark:hover:border-[#62605b] font-semibold text-l leading-normal rounded-md"
                                style="border:1px solid #fff">
                                Register
                            </a>
                        @endif
                    @endauth
                </header> --}}
            </nav>
        @endif
        <div>
            <x-navbar></x-navbar>
        </div>
    </header>
    <div
        class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">

    </div>

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif

    {{-- <div>
    <x-slider>
    </div> --}}

    <div>
        <x-footer />
    </div>
