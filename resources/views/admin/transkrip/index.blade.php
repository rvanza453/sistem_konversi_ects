<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Transkrip Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.transkrip.index') }}" method="GET">
                        <label for="npm" class="block text-gray-700 text-sm font-bold mb-2">Masukkan NPM Mahasiswa:</label>
                        <div class="flex">
                            <input type="text" name="npm" id="npm" value="{{ request('npm') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
             @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            {{-- PERUBAHAN UTAMA: dari $mahasiswa menjadi $biodata --}}
            @if ($biodata)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Data Mahasiswa</h3>
                    {{-- Ganti cara memanggil nama, karena bisa jadi user belum terhubung --}}
                    <p><strong>Nama:</strong> {{ $biodata->user->name ?? 'Belum Registrasi Akun' }}</p>
                    <p><strong>NPM:</strong> {{ $biodata->npm }}</p>
                    <hr class="my-6">

                    <h3 class="text-lg font-semibold mb-4">Tambah Mata Kuliah ke Transkrip</h3>
                    <form action="{{ route('admin.transkrip.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="biodata_id" value="{{ $biodata->id }}">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="mata_kuliah_id" class="block text-gray-700 text-sm font-bold mb-2">Mata Kuliah</label>
                                <select name="mata_kuliah_id" id="mata_kuliah_id" class="shadow border rounded w-full py-2 px-3" required>
                                    <option value="">-- Pilih Mata Kuliah --</option>
                                    @foreach ($mataKuliahs as $mk)
                                        <option value="{{ $mk->id }}">{{ $mk->kode_mk }} - {{ $mk->nama_mk }}</option>
                                    @endforeach
                                </select>
                                {{-- Tambahkan blok error ini --}}
                                @error('mata_kuliah_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="nilai" class="block text-gray-700 text-sm font-bold mb-2">Nilai</label>
                                <input type="text" name="nilai" id="nilai" placeholder="Contoh: A" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                                {{-- Tambahkan blok error ini --}}
                                @error('nilai')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-transparent text-sm font-bold mb-2">Aksi</label>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                                    + Tambahkan
                                </button>
                            </div>
                        </div>
                    </form>

                    <h3 class="text-lg font-semibold mt-8 mb-4">Transkrip Saat Ini</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode MK</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama MK</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bobot ECTS</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($transkrips as $transkrip)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $transkrip->mataKuliah->kode_mk }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $transkrip->mataKuliah->nama_mk }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $transkrip->nilai }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $transkrip->mataKuliah->total_ects }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('admin.transkrip.destroy', $transkrip) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center">Belum ada data transkrip.</td>
                            </tr>
                            @endforelse
                            <tr class="bg-gray-100 font-bold">
                                <td colspan="3" class="px-6 py-4 text-right">TOTAL ECTS</td>
                                <td class="px-6 py-4">{{ $totalEcts }}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>