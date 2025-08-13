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
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
        <link href="{{ asset('css/reset-password.css') }}" rel="stylesheet" />

        <link href="{{ asset('admin/css/styles.css') }}" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- </x-guest-layout> --}}
        <div>
        </div>
