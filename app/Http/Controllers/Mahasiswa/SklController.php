<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class SklController extends Controller
{
    public function cetak()
    {
        $user = Auth::user();
        $biodata = $user->biodata;

        // Pastikan mahasiswa sudah mengisi biodata
        if (!$biodata) {
            return redirect()->route('biodata.edit')->with('error', 'Harap lengkapi biodata Anda terlebih dahulu.');
        }

        $transkrips = $user->transkrips()->with('mataKuliah')->get();

        $totalSks = $transkrips->sum(function ($transkrip) {
            return $transkrip->mataKuliah->bobot_sks ?? 0;
        });
        
        $totalEcts = $transkrips->sum(function ($transkrip) {
            return $transkrip->mataKuliah->total_ects ?? 0;
        });

        $pdf = Pdf::loadView('mahasiswa.skl.template', compact('user', 'biodata', 'transkrips', 'totalSks', 'totalEcts'));

        // Opsi: stream() untuk menampilkan di browser, download() untuk langsung mengunduh
        return $pdf->stream('SKL Konversi ECTS - ' . $biodata->npm . '.pdf');
    }
}