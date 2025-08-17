<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lengkapi Biodata Anda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if($biodata->photo)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $biodata->photo) }}" alt="Foto Profil" class="w-32 h-32 rounded-full object-cover">
                        </div>
                    @endif

                    <form action="{{ route('biodata.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nama</label>
                            <input type="text" value="{{ $user->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-200" disabled>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input type="email" value="{{ $user->email }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-200" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="npm" class="block text-gray-700 text-sm font-bold mb-2">NPM</label>
                            <input type="text" name="npm" id="npm" value="{{ old('npm', $biodata->npm) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                        </div>
                         <div class="mb-4">
                            <label for="no_hp" class="block text-gray-700 text-sm font-bold mb-2">No. HP</label>
                            <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $biodata->no_hp) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                        </div>
                         <div class="mb-4">
                            <label for="photo" class="block text-gray-700 text-sm font-bold mb-2">Upload Foto (Opsional)</label>
                            <input type="file" name="photo" id="photo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                        </div>

                        <div class="flex items-center justify-start">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>