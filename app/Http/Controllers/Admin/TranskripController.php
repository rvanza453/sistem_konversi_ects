<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use App\Models\MataKuliah;
use App\Models\Transkrip;
use Illuminate\Http\Request;

class TranskripController extends Controller
{
    // Fungsi untuk menampilkan transkrip
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            // Jika admin, tampilkan semua transkrip
            $transcripts = Transcript::all();
        } else {
            // Jika mahasiswa, HANYA tampilkan transkrip miliknya
            $transcripts = Transcript::where('user_id', $user->id)->get();
        }

        return view('transcripts.index', compact('transcripts'));
    }

    // Fungsi untuk menyimpan transkrip baru (HANYA ADMIN)
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'mata_kuliah' => 'required|string|max:255',
            'nilai' => 'required|string|max:2', // misal: A, B+, C
            'sks' => 'required|integer|min:1',
        ]);

        // 2. Logika Konversi ECTS (contoh sederhana)
        $ects = $this->konversiKeECTS($validatedData['nilai']);
        $validatedData['ects'] = $ects;


        // 3. Simpan ke database
        Transcript::create($validatedData);

        return redirect()->route('transcripts.index')->with('success', 'Transkrip berhasil ditambahkan.');
    }

    /**
     * Fungsi untuk konversi nilai ke ECTS.
     * Taruh logika ini di sini atau di dalam Service Class agar lebih rapi.
     */
    private function konversiKeECTS(string $nilai): string
    {
        $tabelKonversi = [
            'A'  => 'A',
            'A-' => 'A',
            'B+' => 'B',
            'B'  => 'B',
            'B-' => 'C',
            'C+' => 'C',
            'C'  => 'D',
            'D'  => 'E',
            'E'  => 'F',
        ];

        return $tabelKonversi[$nilai] ?? 'F';
    }
}