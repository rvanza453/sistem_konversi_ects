<x-guest-layout>
    <div class="mb-4 text-center">
         <h2 class="text-2xl font-bold text-gray-900">Lupa Password?</h2>
        <p class="mt-2 text-sm text-gray-600">
            Masukkan alamat email Anda dan kami akan mengirimkan link untuk mengatur ulang password.
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <label for="email" class="block font-medium text-sm text-gray-800">{{ __('Email') }}</label>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="inline-flex items-center justify-center w-full px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-700 active:bg-orange-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Kirim Link Reset Password') }}
            </button>
        </div>
    </form>
</x-guest-layout>