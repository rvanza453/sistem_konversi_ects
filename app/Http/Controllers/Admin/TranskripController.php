<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use App\Models\MataKuliah;
use App\Models\Transkrip;
use Illuminate\Http\Request;

class TranskripController extends Controller
{
    public function index(Request $request)
    {
        $biodata = null;
        $transkrips = collect(); // Gunakan collection kosong sebagai default
        $totalEcts = 0;

        if ($request->has('npm') && $request->npm != '') {
            // Cari biodata berdasarkan NPM. Jika tidak ada, buat baru.
            $biodata = Biodata::firstOrCreate(
                ['npm' => $request->npm],
                // Tidak perlu mengisi field lain saat create, akan diisi mahasiswa nanti
            );

            // Muat relasi transkrip dan mata kuliah
            $biodata->load('transkrips.mataKuliah');
            $transkrips = $biodata->transkrips;

            $totalEcts = $transkrips->sum(function ($transkrip) {
                return $transkrip->mataKuliah->total_ects ?? 0;
            });
        }

        $mataKuliahs = MataKuliah::orderBy('nama_mk')->get();

        // Ganti 'mahasiswa' dengan 'biodata' saat mengirim ke view
        return view('admin.transkrip.index', compact('biodata', 'mataKuliahs', 'transkrips', 'totalEcts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'biodata_id' => 'required|exists:biodatas,id', // Validasi ke tabel biodatas
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'nilai' => 'required|string|max:2',
        ]);
        
        Transkrip::create($request->all());

        $npm = Biodata::find($request->biodata_id)->npm;

        return redirect()->route('admin.transkrip.index', ['npm' => $npm])->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function destroy(Transkrip $transkrip)
    {
        $npm = $transkrip->biodata->npm;
        $transkrip->delete();

        return redirect()->route('admin.transkrip.index', ['npm' => $npm])->with('success', 'Entri transkrip berhasil dihapus.');
    }
}