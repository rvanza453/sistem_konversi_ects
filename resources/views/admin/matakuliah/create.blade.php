<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Mata Kuliah Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.matakuliah.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nama_mk" class="block text-gray-700 text-sm font-bold mb-2">Nama MK</label>
                            <input type="text" name="nama_mk" id="nama_mk" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="kode_mk" class="block text-gray-700 text-sm font-bold mb-2">Kode MK</label>
                            <input type="text" name="kode_mk" id="kode_mk" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                         <div class="mb-4">
                            <label for="bobot_sks" class="block text-gray-700 text-sm font-bold mb-2">Bobot (sks)</label>
                            <input type="number" name="bobot_sks" id="bobot_sks" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                         <div class="mb-4">
                            <label for="sks_kuliah" class="block text-gray-700 text-sm font-bold mb-2">Bentuk Kuliah (sks)</label>
                            <input type="number" name="sks_kuliah" id="sks_kuliah" value="0" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="sks_seminar" class="block text-gray-700 text-sm font-bold mb-2">Bentuk Seminar (sks)</label>
                            <input type="number" name="sks_seminar" id="sks_seminar" value="0" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="sks_praktek" class="block text-gray-700 text-sm font-bold mb-2">Bentuk Praktek (sks)</label>
                            <input type="number" name="sks_praktek" id="sks_praktek" value="0" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Simpan
                            </button>
                            <a href="{{ route('admin.matakuliah.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>