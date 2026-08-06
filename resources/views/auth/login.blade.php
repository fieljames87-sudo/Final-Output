<x-guest-layout>
    <div class="w-full max-w-md mx-auto mt-10 bg-white p-6 rounded-xl shadow-lg">

        <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-input-error :messages="$errors->all()" class="mb-4" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full"
                    type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                    type="password" name="password" required />
            </div>

            <!-- Remember -->
            <div class="block mt-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col gap-3 mt-6">

                <!-- Login Button -->
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg">
                    Log in
                </button>

                <!-- Register Button -->
                <a href="{{ route('register') }}"
                   class="w-full text-center bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg">
                    Register
                </a>

            </div>

            <!-- Forgot Password -->
            @if (Route::has('password.request'))
                <div class="mt-4 text-center">
                    <a class="text-sm text-gray-600 hover:underline"
                       href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                </div>
            @endif

        </form>

    </div>
</x-guest-layout>