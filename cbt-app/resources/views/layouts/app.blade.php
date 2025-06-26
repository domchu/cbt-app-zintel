<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Zintel Academy | Computer Base Test') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts & CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Dark Mode Styling */
        body.dark-mode {
            background-color: #121212 !important;
            color: #f1f1f1 !important;
        }

        body.dark-mode .bg-white,
        body.dark-mode .card,
        body.dark-mode .dark-mode-container {
            background-color: #1e1e1e !important;
            color: #f1f1f1 !important;
        }

        body.dark-mode .text-dark {
            color: #f1f1f1 !important;
        }

        body.dark-mode .btn {
            background-color: #2c2c2c !important;
            color: #f1f1f1 !important;
            border-color: #555 !important;
        }

        body.dark-mode hr {
            border-color: #444 !important;
        }

        body.dark-mode #resultCard {
            background-color: #1e1e1e !important;
            color: #f1f1f1 !important;
            border-color: #444 !important;
        }

        body.dark-mode #resultCard hr {
            border-color: #666 !important;
        }

        body.dark-mode .btn-outline-primary {
            border-color: #90cdf4 !important;
            color: #90cdf4 !important;
        }

        body.dark-mode .btn-outline-primary:hover {
            background-color: #90cdf4 !important;
            color: #121212 !important;
        }

        .dark-mode-container {
            transition: background-color 0.4s, color 0.4s;
        }
        body:not(.dark-mode) .dark-mode-container {
    background-color: #ffffff !important;
    color: #212529 !important;
}
body.dark-mode #resultCard {
    border-color: #444 !important;
}
body.dark-mode {
    background-color: #121212 !important;
    color: #f1f1f1 !important;
}

    </style>
</head>

<body class="font-sans antialiased" id="appBody">

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
        <main>
            <div class="container-fluid px-4 container">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
       document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('darkModeToggle');
    const themeIcon = document.getElementById('themeIcon');
    const body = document.getElementById('appBody');

    function applyTheme(theme) {
        if (theme === 'dark') {
            body.classList.add('dark-mode');
            if (themeIcon) themeIcon.textContent = '🌞';
        } else {
            body.classList.remove('dark-mode');
            if (themeIcon) themeIcon.textContent = '🌙';
        }
    }

    const savedTheme = localStorage.getItem('theme');

    if (savedTheme) {
        applyTheme(savedTheme);
    } else if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
        applyTheme('dark');
    } else {
        applyTheme('light');
    }

    toggleButton.addEventListener('click', () => {
        const newTheme = body.classList.contains('dark-mode') ? 'light' : 'dark';
        applyTheme(newTheme);
        localStorage.setItem('theme', newTheme);
    });
});

    </script>
    
</body>

</html>
