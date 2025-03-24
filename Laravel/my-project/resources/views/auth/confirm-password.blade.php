<x-guest-layout>
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-md p-6 bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <h2 class="text-2xl font-semibold text-center text-gray-900 dark:text-gray-100">
                {{ __('Confirm Password') }}
            </h2>

            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 text-center">
                {{ __('For security reasons, please confirm your password before proceeding.') }}
            </p>

            <form method="POST" action="{{ route('password.confirm') }}" class="mt-4">
                @csrf

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-4">
                    <x-primary-button class="w-full py-2">
                        {{ __('Confirm') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
