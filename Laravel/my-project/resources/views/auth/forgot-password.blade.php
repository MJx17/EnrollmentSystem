<x-guest-layout>
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-md p-6 bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <h2 class="text-2xl font-semibold text-center text-gray-900 dark:text-gray-100">
                {{ __('Forgot Password') }}
            </h2>

            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 text-center">
                {{ __('No worries! Just enter your email below, and we will send you a password reset link.') }}
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="mt-4">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email Address')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="w-full py-2">
                        {{ __('Send Reset Link') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
