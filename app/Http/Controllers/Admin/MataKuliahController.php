<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MataKuliah;

class MataKuliahController extends Controller
    {
    public function index()
    {
        $mataKuliahs = MataKuliah::all();
        return view('admin.matakuliah.index', compact('mataKuliahs'));
    }

    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'nama_mk' => 'required|string|max:255',
            'kode_mk' => 'required|string|max:255|unique:mata_kuliahs',
            'bobot_sks' => 'required|integer',
            'sks_kuliah' => 'required|integer',
            'sks_seminar' => 'required|integer',
            'sks_praktek' => 'required|integer',
        ]);

        MataKuliah::create($request->all());

        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }
    // ... implementasi method lainnya (create, edit, update, destroy)
}
