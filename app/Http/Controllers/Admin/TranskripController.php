<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MataKuliah;
use App\Models\Transkrip;
use Illuminate\Http\Request;

class TranskripController extends Controller
{
    /**
     * Menampilkan halaman input transkrip.
     * Jika ada NPM di request, cari dan tampilkan data mahasiswa.
     */
    public function index(Request $request)
    {
        $mahasiswa = null;
        $transkrips = null;
        $totalEcts = 0;

        if ($request->has('npm') && $request->npm != '') {
            $mahasiswa = User::whereHas('biodata', function ($query) use ($request) {
                $query->where('npm', $request->npm);
            })->with('biodata', 'transkrips.mataKuliah')->first();

            if ($mahasiswa) {
                $transkrips = $mahasiswa->transkrips;
                $totalEcts = $transkrips->sum(function ($transkrip) {
                    return $transkrip->mataKuliah->total_ects ?? 0;
                });
            } else {
                // Beri pesan jika mahasiswa tidak ditemukan
                return redirect()->route('admin.transkrip.index')->with('error', 'Mahasiswa dengan NPM tersebut tidak ditemukan.');
            }
        }

        $mataKuliahs = MataKuliah::orderBy('nama_mk')->get();

        return view('admin.transkrip.index', compact('mahasiswa', 'mataKuliahs', 'transkrips', 'totalEcts'));
    }

    /**
     * Menyimpan entri transkrip baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'nilai' => 'required|string|max:2',
        ]);
        
        // Cek agar mata kuliah yang sama tidak diinput dua kali untuk user yang sama
        $existing = Transkrip::where('user_id', $request->user_id)
                             ->where('mata_kuliah_id', $request->mata_kuliah_id)
                             ->exists();

        if ($existing) {
             return back()->with('error', 'Mata kuliah ini sudah ada di transkrip mahasiswa.');
        }

        Transkrip::create($request->all());

        // Ambil NPM mahasiswa untuk redirect kembali ke halaman yang sama
        $npm = User::find($request->user_id)->biodata->npm;

        return redirect()->route('admin.transkrip.index', ['npm' => $npm])->with('success', 'Mata kuliah berhasil ditambahkan ke transkrip.');
    }
    
    /**
     * Menghapus entri transkrip.
     */
    public function destroy(Transkrip $transkrip)
    {
        $npm = $transkrip->user->biodata->npm;
        $transkrip->delete();

        return redirect()->route('admin.transkrip.index', ['npm' => $npm])->with('success', 'Entri transkrip berhasil dihapus.');
    }
}