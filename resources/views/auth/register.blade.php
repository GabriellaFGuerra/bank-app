<x-guest-layout>
    <div class="p-8 w-96 rounded-lg shadow-2xl">

        <h2 class="mb-6 text-2xl font-bold text-center text-gray-400">Create Account</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block mb-2 font-medium text-gray-400">Name</label>
                <x-text-input type="text" id="name" name="name" class="p-2 w-full" :value="old('name')" required
                    autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block mb-2 font-medium text-gray-400">Email</label>
                <x-text-input type="email" id="email" name="email" class="p-2 w-full" :value="old('email')" required
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>


            <!-- CPF -->
            <div class="mb-4">
                <label for="cpf" class="block mb-2 font-medium text-gray-400">CPF</label>
                <x-text-input type="text" id="cpf" name="cpf" class="p-2 w-full" :value="old('cpf')" required
                    autofocus autocomplete="cpf" />
                    <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
            </div>

            <!-- Address -->
            <div class="mb-4">
                <label for="address" class="block mb-2 font-medium text-gray-400">Address</label>
                <x-text-input type="text" id="address" name="address" class="p-2 w-full" :value="old('address')" required
                    autofocus autocomplete="address" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <!-- Birthday -->
            <div class="mb-4">
                <label for="birthday" class="block mb-2 font-medium text-gray-400">Birth date</label>
                <x-text-input type="date" id="birthday" name="birthday" class="p-2 w-full" :value="old('birthday')"
                    required autofocus autocomplete="birthday" />
                    <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block mb-2 font-medium text-gray-400">Password</label>
                <x-text-input type="password" id="password" name="password" class="p-2 w-full" required
                    autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block mb-2 font-medium text-gray-400">Confirm Password</label>
                <x-text-input type="password" id="password_confirmation" name="password_confirmation" class="p-2 w-full"
                    required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit"
                class="px-4 py-2 w-full font-medium text-white bg-blue-500 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">Register</button>
        </form>

        <p class="mt-4 text-center text-gray-600">Already have an account? <a href="{{ route('login') }}"
                class="text-blue-500 hover:text-blue-700">Sign in</a></p>

    </div>
</x-guest-layout>
