<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Biodata;

class BiodataController extends Controller
{
    /**
     * Menampilkan form untuk mengedit biodata.
     */
    public function edit()
    {
        $user = Auth::user();
        // Ambil biodata, atau buat instance baru jika belum ada
        $biodata = $user->biodata ?? new Biodata();

        return view('mahasiswa.biodata.edit', compact('user', 'biodata'));
    }

    /**
     * Memperbarui biodata di database.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'npm' => 'required|string|max:15|unique:biodatas,npm,' . ($user->biodata->id ?? 'NULL') . ',id',
            'no_hp' => 'required|string|max:15',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Foto tidak wajib, maks 2MB
        ]);

        $dataToUpdate = [
            'npm' => $request->npm,
            'no_hp' => $request->no_hp,
        ];

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->biodata && $user->biodata->photo) {
                \Storage::disk('public')->delete($user->biodata->photo);
            }
            // Simpan foto baru dan dapatkan path-nya
            $path = $request->file('photo')->store('photos', 'public');
            $dataToUpdate['photo'] = $path;
        }

        // Gunakan updateOrCreate untuk handle kasus biodata belum ada atau sudah ada
        $user->biodata()->updateOrCreate(
            ['user_id' => $user->id],
            $dataToUpdate
        );

        return redirect()->route('biodata.edit')->with('success', 'Biodata berhasil diperbarui.');
    }
}