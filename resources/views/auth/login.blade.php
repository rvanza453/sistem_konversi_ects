<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-4">
        <h2 class="text-2xl font-bold text-gray-900">
            Selamat Datang Kembali!
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            Silakan masuk untuk melanjutkan.
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            {{-- Mengubah komponen label menjadi tag biasa dengan warna teks hitam --}}
            <label for="email" class="block font-medium text-sm text-gray-800">{{ __('Email') }}</label>
            
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            {{-- Mengubah komponen label menjadi tag biasa dengan warna teks hitam --}}
            <label for="password" class="block font-medium text-sm text-gray-800">{{ __('Password') }}</label>
            
            <x-text-input id="password" class="block w-full mt-1"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="text-orange-600 border-gray-300 rounded shadow-sm focus:ring-orange-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-orange-600 underline rounded-md hover:text-orange-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="inline-flex items-center justify-center w-full px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-orange-600 border border-transparent rounded-md hover:bg-orange-700 active:bg-orange-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                {{ __('Masuk') }}
            </button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-medium text-orange-600 underline hover:text-orange-500">
                    Daftar di sini
                </a>
            </p>
        </div>
    @endif
</x-guest-layout>