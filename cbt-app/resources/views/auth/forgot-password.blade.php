<div class="login-wrapper">
    <div class="bg-container">
        <div class="bg-image bg-image-1"></div>
        <div class="bg-image bg-image-2"></div>
    </div>

    <!-- Logo Status -->
    <div class="login-box">
        <div class="logo-container text-center mb-4" style="display:flex;justify-content:center;margin-bottom:30px">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/logo.png') }}" alt="Brand Logo" width="100" />
            </a>
        </div>
        <div class="my-8 text-center font-bold">
            <h2>Forgot Password ! No Qualms</h2>
        </div>

        {{-- <x-guest-layout> --}}
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button>
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>
            </form>
               <link href="{{ asset('css/forgot-password.css') }}" rel="stylesheet" />
           
        <link href="{{ asset('admin/css/styles.css') }}" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- </x-guest-layout> --}}
     <div>
 </div>
