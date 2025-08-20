<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Mata Kuliah Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.matakuliah.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="kode_mk" class="block text-sm font-medium text-gray-700">Kode MK</label>
                                <input type="text" name="kode_mk" id="kode_mk" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500" required>
                            </div>
                            <div>
                                <label for="nama_mk" class="block text-sm font-medium text-gray-700">Nama MK</label>
                                <input type="text" name="nama_mk" id="nama_mk" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500" required>
                            </div>
                            <div>
                                <label for="bobot_sks" class="block text-sm font-medium text-gray-700">Bobot (sks)</label>
                                <input type="number" name="bobot_sks" id="bobot_sks" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500" required>
                            </div>
                             <div>
                                <label for="sks_kuliah" class="block text-sm font-medium text-gray-700">Bentuk Kuliah (sks)</label>
                                <input type="number" name="sks_kuliah" id="sks_kuliah" value="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500" required>
                            </div>
                            <div>
                                <label for="sks_seminar" class="block text-sm font-medium text-gray-700">Bentuk Seminar (sks)</label>
                                <input type="number" name="sks_seminar" id="sks_seminar" value="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500" required>
                            </div>
                            <div>
                                <label for="sks_praktek" class="block text-sm font-medium text-gray-700">Bentuk Praktek (sks)</label>
                                <input type="number" name="sks_praktek" id="sks_praktek" value="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500" required>
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                             <a href="{{ route('admin.matakuliah.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-700">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>