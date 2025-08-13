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
            <h2>Please Confirm Your Password</h2>
        </div>

        {{-- <x-guest-layout> --}}
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-end mt-4">
                <x-primary-button>
                    {{ __('Confirm') }}
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
