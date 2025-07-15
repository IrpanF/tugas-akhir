<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Title & Subtitle -->
        <div class="text-center mb-6">
            <h2 class="text-lg font-semibold text-gray-700">Masuk ke Gold Prediction</h2>
            <p class="text-xs text-gray-500 mt-1">Silakan masukkan informasi akun Anda.</p>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-10"
                            type="password" name="password" required autocomplete="current-password" />
                <button type="button" onclick="togglePassword('password', 'togglePasswordIcon')" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600">
                    <svg id="togglePasswordIcon" xmlns="http://www.w3.org/2000/svg" 
                        class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 3C5 3 1.73 7.11 1 10c.73 2.89 4 7 9 7s8.27-4.11 9-7c-.73-2.89-4-7-9-7zm0 12a5 5 0 110-10 5 5 0 010 10zm0-8a3 3 0 100 6 3 3 0 000-6z"/>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" 
                   href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <div class="mt-4">
            <button type="submit" class="w-full px-6 py-2 text-white bg-[#7091F5] rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ __('Log in') }}
            </button>
        </div>

        <!-- Register Link -->
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                {{ __('Belum memiliki akun?') }}
                <a href="{{ route('register') }}" class="text-[#7091F5] hover:underline">{{ __('Daftar Sekarang') }}</a>
            </p>
        </div>
    </form>

    <!-- JavaScript -->
    <script>
        function togglePassword(inputId, iconId) {
            let input = document.getElementById(inputId);
            let icon = document.getElementById(iconId);

            if (input.type === "password") {
                input.type = "text";
                icon.innerHTML = '<path d="M4.318 4.318a1 1 0 011.415 0L10 8.586l4.267-4.268a1 1 0 111.415 1.415L11.414 10l4.268 4.267a1 1 0 01-1.415 1.415L10 11.414l-4.267 4.268a1 1 0 01-1.415-1.415L8.586 10 4.318 5.733a1 1 0 010-1.415z"/>';
            } else {
                input.type = "password";
                icon.innerHTML = '<path d="M10 3C5 3 1.73 7.11 1 10c.73 2.89 4 7 9 7s8.27-4.11 9-7c-.73-2.89-4-7-9-7zm0 12a5 5 0 110-10 5 5 0 010 10zm0-8a3 3 0 100 6 3 3 0 000-6z"/>';
            }
        }
    </script>
</x-guest-layout>
