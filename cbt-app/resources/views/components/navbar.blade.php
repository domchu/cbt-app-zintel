<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Zintel Academy | Computer Base Test') }}</title>
    {{-- CUSTOM CSS --}}
    @vite(['resources/css/app.css', 'resources/css/navbar.css'])
    @vite('resources/css/faqSection.css')
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">


</head>

<body class="antialiased">
    {{-- NAVBAR --}}
    <!-- Topnav: Contact Info & Auth Links (Hidden on mobile) -->
    <div
        class="bg-[#32064a] rounded-lg dark:bg-gray-900 text-sm py-6 my-3 px-4 hidden sm:flex justify-between items-center max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Left: Contact Info -->
        <div class="text-white dark:text-gray-300 space-x-8">
            <a href="tel:+234 805 6256 805 " class="text-white dark:text-white font-semibold hover:text-gray-300 transition">📞
                (+234)
                805 6256 805</a>

            <a href="mailto:zintelacademy@gmail.com"
                class="text-white dark:text-white font-semibold hover:text-gray-300 transition">✉️
                zintelacademy@gmail.com</a>

        </div>
        <!-- Right: Login / Sign Up -->
        <div class="space-x-4">
            <a href="{{ url('/login') }}"
            class="inline-block px-4 py-2 bg-[#e9492d] text-white font-semibold rounded hover:bg-red-700 transition hover:text-gray-300">
            Login
        </a>
            <a href={{ url('/register') }} class="text-white dark:text-white font-semibold hover:text-blue-500">Sign
                Up</a>
            <a href="{{ url('/login') }}"
                class="inline-block px-4 py-2 bg-[#e9492d] text-white font-semibold rounded hover:bg-red-700 transition hover:text-gray-300">
                Go to CBT
            </a>

        </div>
    </div>

    <!-- Main Navbar -->
    <nav class="sticky top-0 z-50 bg-white shadow-md dark:bg-gray-900 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/">
                        <img src="./assets/logo.png" alt="Brand Logo" sizes="0" width="80px" srcset="">
                    </a>
                    
                </div>

                <!-- Desktop Links -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="/" class="text-gray-700 dark:text-gray-200 font-bold hover:text-red-700 transition">Home</a>
                    <a href={{ url('/about-us') }} class="text-gray-700 font-bold dark:text-gray-200 hover:text-red-700 transition">About
                        Us</a>
                        <a href={{ url('/instructions') }} class="text-gray-700 font-bold dark:text-gray-200 hover:text-red-700 transition">Instructions</a>
                    {{-- <a href={{ url('/gallery') }}
                        class="text-gray-700 dark:text-gray-200 font-bold hover:text-red-700 transition">Gallery</a> --}}
                    <a href={{ url('/contact-us') }}
                        class="text-gray-700 dark:text-gray-200 font-bold hover:text-red-700 transition">Contact</a>
                    <a href={{ url('/faq') }}
                        class="text-gray-700 dark:text-gray-200 font-bold hover:text-red-700 transition">FAQ</a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobileMenuBtn" class="text-gray-700 dark:text-gray-200 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="overflow-hidden max-h-0 transition-all duration-500 ease-in-out md:hidden px-4">
            <a href="#" class="block py-2 text-gray-700 dark:text-gray-200 hover:text-red-700 transition">Home</a>
            <a href={{ url('/about-us') }} class="block py-2 text-gray-700 dark:text-gray-200 hover:text-red-700 transition">About
                Us</a>
            <a href={{ url('/gallery') }}
                class="block py-2 text-gray-700 dark:text-gray-200 hover:text-red-700 transition">Gallery</a>
            <a href={{ url('/contact-us') }}
                class="block py-2 text-gray-700 dark:text-gray-200 hover:text-red-700 transition">Contact</a>
            <a href={{ url('/frequently-asked-questions.') }}
                class="block py-2 text-gray-700 dark:text-gray-200 hover:text-red-700 transition">FAQ</a>
        </div>
    </nav>
