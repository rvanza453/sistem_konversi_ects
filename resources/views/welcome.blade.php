<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistem Konversi ECTS</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-50 text-gray-800">
        <div class="relative min-h-screen flex flex-col items-center justify-center">
            
            <header class="w-full p-6 fixed top-0 z-10">
                @if (Route::has('login'))
                    <nav class="flex flex-1 justify-end space-x-2">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="rounded-md px-4 py-2 text-gray-700 ring-1 ring-transparent transition hover:text-black focus:outline-none">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="rounded-md px-4 py-2 text-gray-700 ring-1 ring-transparent transition hover:text-black focus:outline-none">
                                Masuk
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="rounded-md px-4 py-2 text-gray-700 ring-1 ring-transparent transition hover:text-black focus:outline-none">
                                    Daftar
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>

            <main class="flex flex-col items-center justify-center w-full px-6 pt-24 pb-12">
                <div class="text-center max-w-3xl">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                        Konversi Nilai & SKS ke Standar ECTS dengan Mudah
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        Sistem kami membantu mahasiswa dan admin akademik untuk mengkonversi nilai ke standar ECTS secara cepat, akurat, dan terpusat.
                    </p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <a href="{{ route('register') }}" class="rounded-md bg-orange-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600">
                            Daftar Sekarang
                        </a>
                        <a href="#alur-sistem" class="text-sm font-semibold leading-6 text-gray-900">
                            Lihat Alur Sistem <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>

                <div id="alur-sistem" class="mt-24 w-full max-w-5xl space-y-16">
                    
                    <div>
                        <h2 class="text-center text-3xl font-bold text-gray-900">Alur Kerja Mahasiswa</h2>
                        <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-3">
                            <div class="p-6 bg-white rounded-lg shadow-sm text-center">
                                <div class="flex items-center justify-center h-12 w-12 rounded-full bg-orange-100 text-orange-600 mx-auto font-bold text-xl">1</div>
                                <h3 class="mt-5 text-lg font-medium text-gray-900">Daftar & Lengkapi Biodata</h3>
                                <p class="mt-2 text-sm text-gray-500">Buat akun, lalu isi data diri Anda seperti NPM dan No. HP pada halaman Biodata.</p>
                            </div>
                            <div class="p-6 bg-white rounded-lg shadow-sm text-center">
                                 <div class="flex items-center justify-center h-12 w-12 rounded-full bg-gray-100 text-gray-600 mx-auto font-bold text-xl">2</div>
                                <h3 class="mt-5 text-lg font-medium text-gray-900">Menunggu Input Nilai</h3>
                                <p class="mt-2 text-sm text-gray-500">Setelah biodata lengkap, tunggu admin untuk menginput transkrip nilai Anda.</p>
                            </div>
                            <div class="p-6 bg-white rounded-lg shadow-sm text-center">
                                 <div class="flex items-center justify-center h-12 w-12 rounded-full bg-orange-100 text-orange-600 mx-auto font-bold text-xl">3</div>
                                <h3 class="mt-5 text-lg font-medium text-gray-900">Cetak SKL & Hasil</h3>
                                <p class="mt-2 text-sm text-gray-500">Jika nilai sudah diinput, Anda dapat langsung mengunduh dan mencetak Surat Keterangan Lulus (SKL) dengan konversi ECTS.</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-center text-3xl font-bold text-gray-900">Alur Kerja Admin</h2>
                        <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-3">
                            <div class="p-6 bg-white rounded-lg shadow-sm text-center">
                                <div class="flex items-center justify-center h-12 w-12 rounded-full bg-orange-100 text-orange-600 mx-auto font-bold text-xl">1</div>
                                <h3 class="mt-5 text-lg font-medium text-gray-900">Kelola Mata Kuliah</h3>
                                <p class="mt-2 text-sm text-gray-500">Siapkan data master mata kuliah beserta bobot SKS dan ECTS-nya sebagai dasar konversi.</p>
                            </div>
                            <div class="p-6 bg-white rounded-lg shadow-sm text-center">
                                 <div class="flex items-center justify-center h-12 w-12 rounded-full bg-orange-100 text-orange-600 mx-auto font-bold text-xl">2</div>
                                <h3 class="mt-5 text-lg font-medium text-gray-900">Cari & Input Transkrip</h3>
                                <p class="mt-2 text-sm text-gray-500">Cari mahasiswa berdasarkan NPM, lalu input nilai mata kuliah satu per satu ke dalam transkripnya.</p>
                            </div>
                            <div class="p-6 bg-white rounded-lg shadow-sm text-center">
                                 <div class="flex items-center justify-center h-12 w-12 rounded-full bg-gray-100 text-gray-600 mx-auto font-bold text-xl">3</div>
                                <h3 class="mt-5 text-lg font-medium text-gray-900">Validasi & Monitoring</h3>
                                <p class="mt-2 text-sm text-gray-500">Pastikan semua data transkrip mahasiswa sudah benar dan terisi agar mereka bisa mencetak SKL.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <footer class="py-16 text-center text-sm text-gray-500">
                © {{ date('Y') }} Sistem Konversi ECTS. All rights reserved.
                <br>
                <span class="font-semibold">Developed by Muhammad Revanza</span>
                <br>
                <span class="font-semibold">linkedin: <a href="https://www.linkedin.com/in/muhammad-revanza-0812-3456-7890/">Muhammad Revanza</a></span>
            </footer>
        </div>
    </body>
</html>