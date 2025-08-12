<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="color-scheme" content="light dark"> --}}

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Zintel Academy | Computer Base Test') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts & CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <style>
    body.exam-page {
        margin: 0;
        height: 100vh;
        overflow: hidden;
    }

    .bg-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
    }

    .bg-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        opacity: 0;
        animation: fadeBackground 10s infinite;
        transition: opacity 1s ease-in-out;
    }

    .bg-image:nth-child(1) {
        background-image: url('/images/bg-exam-person.jpg');
        animation-delay: 0s;
    }

    .bg-image:nth-child(2) {
        background-image: url('/images/bg-exam-cap.jpg');
        animation-delay: 5s;
    }

    @keyframes fadeBackground {
        0%, 40% {
            opacity: 1;
        }
        50%, 90% {
            opacity: 0;
        }
    }
</style>
</head>

<body class="font-sans antialiased exam-page" id="appBody">
     <div class="bg-container">
        <div class="bg-image"></div>
        <div class="bg-image"></div>
    </div>

    <div class="min-vh-100 dark-mode-container">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="container max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="color:white; text-align:center; padding-top:50px;">
            <div class="container-fluid px-4 container">
                @yield('content')
            </div>
        </main>
    </div>

   
    

</body>

</html>
