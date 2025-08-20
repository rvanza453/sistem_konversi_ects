<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">
                    
                    {{-- KONTEN UNTUK ADMIN --}}
                    @if(auth()->user()->role == 'admin')
                        <h3 class="text-2xl font-bold">Selamat Datang, Admin!</h3>
                        <p class="mt-2 text-gray-600">Berikut adalah alur kerja yang dapat Anda lakukan di sistem ini:</p>

                        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="p-6 border border-gray-200 rounded-lg">
                                <h4 class="text-lg font-semibold text-orange-600">1. Kelola Mata Kuliah</h4>
                                <p class="mt-2 text-gray-500">Tambahkan atau perbarui daftar mata kuliah yang akan digunakan sebagai acuan untuk konversi nilai.</p>
                                <a href="{{ route('admin.matakuliah.index') }}" class="inline-block mt-4 text-sm font-semibold text-orange-600 hover:text-orange-800">
                                    Buka Halaman Mata Kuliah &rarr;
                                </a>
                            </div>

                            <div class="p-6 border border-gray-200 rounded-lg">
                                <h4 class="text-lg font-semibold text-orange-600">2. Input Transkrip Mahasiswa</h4>
                                <p class="mt-2 text-gray-500">Lakukan input atau impor data transkrip nilai mahasiswa untuk diproses oleh sistem.</p>
                                <a href="{{ route('admin.transkrip.index') }}" class="inline-block mt-4 text-sm font-semibold text-orange-600 hover:text-orange-800">
                                    Buka Halaman Transkrip &rarr;
                                </a>
                            </div>
                        </div>

                    {{-- KONTEN UNTUK MAHASISWA --}}
                    @else
                        <h3 class="text-2xl font-bold">Selamat Datang, {{ Auth::user()->name }}!</h3>
                        <p class="mt-2 text-gray-600">Berikut adalah alur penggunaan sistem untuk Anda sebagai mahasiswa:</p>

                        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                            <div class="p-6">
                                <div class="flex items-center justify-center h-12 w-12 rounded-full bg-orange-100 text-orange-600 mx-auto">
                                    <span class="font-bold text-xl">1</span>
                                </div>
                                <h4 class="mt-4 font-semibold">Lengkapi Biodata</h4>
                                <p class="mt-1 text-sm text-gray-500">Pastikan data diri Anda sudah lengkap dan benar.</p>
                            </div>
                             <div class="p-6">
                                <div class="flex items-center justify-center h-12 w-12 rounded-full bg-gray-100 text-gray-600 mx-auto">
                                     <span class="font-bold text-xl">2</span>
                                </div>
                                <h4 class="mt-4 font-semibold">Tunggu Proses Admin</h4>
                                <p class="mt-1 text-sm text-gray-500">Admin akan menginput transkrip nilai Anda ke dalam sistem.</p>
                            </div>
                             <div class="p-6">
                                <div class="flex items-center justify-center h-12 w-12 rounded-full bg-orange-100 text-orange-600 mx-auto">
                                     <span class="font-bold text-xl">3</span>
                                </div>
                                <h4 class="mt-4 font-semibold">Cetak Hasil Konversi</h4>
                                <p class="mt-1 text-sm text-gray-500">Setelah nilai diinput, Anda dapat mencetak Surat Keterangan Lulus (SKL) dengan nilai ECTS.</p>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>