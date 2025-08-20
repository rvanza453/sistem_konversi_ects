@php
// Logika untuk menentukan kelas CSS link aktif vs tidak aktif
$activeClasses = 'inline-flex items-center px-1 pt-1 border-b-2 border-orange-500 text-sm font-semibold leading-5 text-orange-600 focus:outline-none transition duration-150 ease-in-out';
$inactiveClasses = 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? $activeClasses : $inactiveClasses }}">
                        {{ __('Dashboard') }}
                    </a>

                    {{-- Link Navigasi berdasarkan Role --}}
                    @if(auth()->user()->role == 'admin')
                        <a href="{{ route('admin.matakuliah.index') }}" class="{{ request()->routeIs('admin.matakuliah.*') ? $activeClasses : $inactiveClasses }}">
                            {{ __('Mata Kuliah') }}
                        </a>
                        <a href="{{ route('admin.transkrip.index') }}" class="{{ request()->routeIs('admin.transkrip.*') ? $activeClasses : $inactiveClasses }}">
                            {{ __('Input Transkrip') }}
                        </a>
                        <a href="{{ route('admin.admin.index') }}" class="{{ request()->routeIs('admin.admin.*') ? $activeClasses : $inactiveClasses }}">
                            {{ __('Manajemen Admin') }}
                        </a>
                    @else
                        <a href="{{ route('biodata.edit') }}" class="{{ request()->routeIs('biodata.edit') ? $activeClasses : $inactiveClasses }}">
                            {{ __('Biodata') }}
                        </a>
                        <!-- <a href="{{ route('skl.cetak') }}" class="{{ request()->routeIs('skl.cetak') ? $activeClasses : $inactiveClasses }}" target="_blank">
                            {{ __('Cetak SKL') }}
                        </a> -->
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Setting') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- ... bagian ini tidak perlu diubah ... --}}
        </div>
    </div>
    
    {{-- ... bagian menu responsif tidak perlu diubah ... --}}
</nav>