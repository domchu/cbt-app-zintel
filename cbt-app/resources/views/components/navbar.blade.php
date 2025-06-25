<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Home | Landlord Solutions Made Simple') }}</title>
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
<div class="bg-gray-100 dark:bg-gray-900 text-sm py-6 my-3 px-4 hidden sm:flex justify-between items-center max-w-7xl mx-auto sm:px-6 lg:px-8">
    <!-- Left: Contact Info -->
    <div class="text-gray-600 dark:text-gray-300 space-x-4">
        <span>📞 +234-800-123-4567</span>
        <span>✉️ info@example.com</span>
    </div>
    <!-- Right: Login / Sign Up -->
    <div class="space-x-4">
        <a href={{ url('/login') }} class="text-gray-700 dark:text-gray-200 hover:text-blue-500">Login</a>
        <a href={{ url('/register') }} class="text-blue-600 dark:text-blue-400 font-semibold hover:underline">Sign Up</a>
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
                {{-- <a href="#" class="text-xl font-bold text-gray-800 dark:text-white">MyLogo</a> --}}
            </div>

            <!-- Desktop Links -->
            <div class="hidden md:flex space-x-8 items-center">
                <a href="/" class="text-gray-700 dark:text-gray-200 hover:text-blue-500">Home</a>
                <a href={{ url('/about-us') }} class="text-gray-700 dark:text-gray-200 hover:text-blue-500">About Us</a>
                <a href={{ url('/gallery') }} class="text-gray-700 dark:text-gray-200 hover:text-blue-500">Gallery</a>
                <a href={{ url('/contact-us') }} class="text-gray-700 dark:text-gray-200 hover:text-blue-500">Contact</a>
                <a href={{ url('/frequently-asked-questions.') }} class="text-gray-700 dark:text-gray-200 hover:text-blue-500">FAQ</a>
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
        <a href="#" class="block py-2 text-gray-700 dark:text-gray-200 hover:text-blue-500">Home</a>
        <a href={{ url('/about-us') }} class="block py-2 text-gray-700 dark:text-gray-200 hover:text-blue-500">About Us</a>
        <a href={{ url('/gallery') }} class="block py-2 text-gray-700 dark:text-gray-200 hover:text-blue-500">Gallery</a>
        <a href={{ url('/contact-us') }} class="block py-2 text-gray-700 dark:text-gray-200 hover:text-blue-500">Contact</a>
        <a href={{ url('/frequently-asked-questions.') }} class="block py-2 text-gray-700 dark:text-gray-200 hover:text-blue-500">FAQ</a>
    </div>
</nav>




