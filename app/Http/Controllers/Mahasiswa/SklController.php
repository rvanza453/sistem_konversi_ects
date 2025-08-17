<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SklController extends Controller
{
    public function cetak()
    {
        $user = auth()->user();
        $biodata = $user->biodata;
        $transkrips = $user->transkrips()->with('mataKuliah')->get();

        // Hitung total ECTS dari semua mata kuliah di transkrip
        $totalEcts = $transkrips->sum(function($transkrip) {
            return $transkrip->mataKuliah->total_ects;
        });

        $pdf = Pdf::loadView('skl.template', compact('user', 'biodata', 'transkrips', 'totalEcts'));

        return $pdf->stream('skl-konversi-'.$user->npm.'.pdf');
    }
}
