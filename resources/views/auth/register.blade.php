<x-guest-layout>
    <div class="text-center mb-4">
        <h2 class="text-2xl font-bold text-gray-900">
            Buat Akun Baru
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            Isi data di bawah ini untuk mendaftar.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="npm" class="block font-medium text-sm text-gray-800">{{ __('NPM') }}</label>
            <x-text-input id="npm" class="block mt-1 w-full" type="text" name="npm" :value="old('npm')" required autofocus />
            <x-input-error :messages="$errors->get('npm')" class="mt-2" />
        </div>
        
        <div class="mt-4">
            <label for="name" class="block font-medium text-sm text-gray-800">{{ __('Name') }}</label>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="email" class="block font-medium text-sm text-gray-800">{{ __('Email') }}</label>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="password" class="block font-medium text-sm text-gray-800">{{ __('Password') }}</label>
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="password_confirmation" class="block font-medium text-sm text-gray-800">{{ __('Confirm Password') }}</label>
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm text-orange-600 underline rounded-md hover:text-orange-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500" href="{{ route('login') }}">
                {{ __('Sudah terdaftar?') }}
            </a>

            <button type="submit" class="ms-4 inline-flex items-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-700 active:bg-orange-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Daftar') }}
            </button>
        </div>
    </form>
</x-guest-layout>