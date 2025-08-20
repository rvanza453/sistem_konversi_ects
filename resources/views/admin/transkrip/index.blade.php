<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Transkrip Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Search Box --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.transkrip.index') }}" method="GET">
                        <label for="npm" class="block text-sm font-medium text-gray-700">Masukkan NPM Mahasiswa:</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="text" name="npm" id="npm" value="{{ request('npm') }}" class="flex-1 block w-full rounded-none rounded-l-md border-gray-300 focus:border-orange-500 focus:ring-orange-500" placeholder="Contoh: 21081010..." required>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-r-md text-white bg-orange-600 hover:bg-orange-700">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Alert Messages --}}
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            {{-- Content if Mahasiswa is Found --}}
            @if ($biodata)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 bg-white border-b border-gray-200">
                    <h3 class="text-xl font-bold mb-4">Data Mahasiswa</h3>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <p><strong>Nama:</strong></p> <p>{{ $biodata->user->name ?? 'Belum Registrasi Akun' }}</p>
                        <p><strong>NPM:</strong></p> <p>{{ $biodata->npm }}</p>
                    </div>
                    <hr class="my-6">

                    <h3 class="text-xl font-bold mb-4">Tambah Mata Kuliah ke Transkrip</h3>
                    <form action="{{ route('admin.transkrip.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="biodata_id" value="{{ $biodata->id }}">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
                            <div>
                                <label for="mata_kuliah_id" class="block text-sm font-medium text-gray-700">Mata Kuliah</label>
                                <select name="mata_kuliah_id" id="mata_kuliah_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500" required>
                                    <option value="">-- Pilih Mata Kuliah --</option>
                                    @foreach ($mataKuliahs as $mk)
                                        <option value="{{ $mk->id }}">{{ $mk->kode_mk }} - {{ $mk->nama_mk }}</option>
                                    @endforeach
                                </select>
                                @error('mata_kuliah_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="nilai" class="block text-sm font-medium text-gray-700">Nilai Huruf</label>
                                <input type="text" name="nilai" id="nilai" placeholder="Contoh: A" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500" required>
                                @error('nilai') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-700">
                                    + Tambahkan
                                </button>
                            </div>
                        </div>
                    </form>

                    <h3 class="text-xl font-bold mt-10 mb-4">Transkrip Saat Ini</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode MK</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama MK</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nilai</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bobot ECTS</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
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
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">Hapus</button>
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
                                    <td class="px-6 py-4">{{ $totalEcts ?? 0 }}</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>