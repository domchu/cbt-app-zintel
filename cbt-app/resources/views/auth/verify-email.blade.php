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
            <h2>Thanks for Signing Up! Verify Your Email Address</h2>
        </div>





{{-- <x-guest-layout> --}}
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __('Log Out') }}
            </button>
        </form>
      <link href="{{ asset('css/forgot-password.css') }}" rel="stylesheet" />
           
        <link href="{{ asset('admin/css/styles.css') }}" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- </x-guest-layout> --}}
     <div>
 </div>
