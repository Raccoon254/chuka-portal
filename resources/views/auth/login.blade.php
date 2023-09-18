<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="reg_no" :value="__('Registration Number')" />
            <x-text-input placeholder="Eb3/49091/20" id="reg_no" class="block mt-1 w-full" type="text" name="reg_no" :value="old('reg_no')" required autofocus autocomplete="reg_no" />
            <x-input-error :messages="$errors->get('reg_no')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 relative"> <!-- Add 'relative' class to position the view button absolutely within this div -->
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full pr-10"
            type="password"
            name="password"
            required autocomplete="current-password" />

            <!-- Password view toggle button -->
            <button data-tip="View" type="button" class="mt-1 tooltip absolute inset-y-1/2 right-0 flex items-center px-3 py-2.5 text-gray-500 focus:outline-none">
                <i class="fa-solid fa-eye" id="password-icon"></i> <!-- FontAwesome eye icon. Change to fa-eye-slash when hiding -->
            </button>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const passwordInput = document.getElementById('password');
                const passwordIcon = document.getElementById('password-icon');

                passwordIcon.addEventListener('click', function() {
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        passwordIcon.classList.remove('fa-eye');
                        passwordIcon.classList.add('fa-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        passwordIcon.classList.remove('fa-eye-slash');
                        passwordIcon.classList.add('fa-eye');
                    }
                });
            });

        </script>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <section class="flex items-center justify-between">
            <div class="block mt-4">
                <a href="{{ route('register') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">{{ __('Join Chuka?') }}
                </a>

            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ml-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </section>
    </form>
</x-guest-layout>
