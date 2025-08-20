<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Mata Kuliah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                {{-- PERBAIKAN: Menghapus komentar --}}
                <a href="{{ route('admin.matakuliah.create') }}" class="inline-flex items-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-700">
                    + Tambah Mata Kuliah
                </a>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode MK</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama MK</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bobot SKS</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bobot ECTS</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($mataKuliahs as $index => $mk)
                            <tr>
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">{{ $mk->kode_mk }}</td>
                                <td class="px-6 py-4">{{ $mk->nama_mk }}</td>
                                <td class="px-6 py-4">{{ $mk->bobot_sks }}</td>
                                <td class="px-6 py-4">{{ $mk->total_ects }}</td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    {{-- PERBAIKAN: Menghapus komentar --}}
                                    <a href="{{ route('admin.matakuliah.edit', $mk) }}" class="text-orange-600 hover:text-orange-900">Edit</a>
                                    
                                    {{-- PERBAIKAN: Menghapus komentar --}}
                                    <form action="{{ route('admin.matakuliah.destroy', $mk) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center">Belum ada data mata kuliah.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>