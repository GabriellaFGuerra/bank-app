<x-guest-layout>
    <div class="p-8 w-96 rounded-lg shadow-2xl">
        <h2 class="mb-6 text-2xl font-bold text-center text-gray-400">Welcome Back</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block mb-2 text-gray-400">Email</label>
                <x-text-input type="email" id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autofocus autocomplete="username" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

            </div>
            <div class="mb-4">
                <label for="password" class="block mb-2 text-gray-400">Paswword</label>
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="text-indigo-600 rounded border-gray-300 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-400"
                            name="remember">
                        <span class="text-sm text-gray-400 ms-2">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <a href="{{ route('password.request') }}" class="text-blue-500 hover:text-blue-700">Forgot Password?</a>
            </div>
            <button type="submit"
                class="px-4 py-2 w-full font-medium text-white bg-blue-500 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">Login</button>
        </form>
        <p class="mt-4 text-center text-gray-400">Don't have an account? <a href="{{ route('register') }}"
                class="text-blue-500 hover:text-blue-700">Sign up</a></p>
    </div>
</x-guest-layout>
