<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    /**
     * Menampilkan daftar semua mata kuliah.
     */
    public function index()
    {
        $mataKuliahs = MataKuliah::orderBy('kode_mk')->get();
        return view('admin.matakuliah.index', compact('mataKuliahs'));
    }

    /**
     * Menampilkan form untuk membuat mata kuliah baru.
     */
    public function create()
    {
        return view('admin.matakuliah.create');
    }

    /**
     * Menyimpan mata kuliah baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_mk' => 'required|string|max:255',
            'kode_mk' => 'required|string|unique:mata_kuliahs,kode_mk|max:10',
            'bobot_sks' => 'required|integer|min:1',
            'sks_kuliah' => 'required|integer|min:0',
            'sks_seminar' => 'required|integer|min:0',
            'sks_praktek' => 'required|integer|min:0',
        ]);

        MataKuliah::create($request->all());

        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit mata kuliah.
     */
    public function edit(MataKuliah $matakuliah)
    {
        return view('admin.matakuliah.edit', compact('matakuliah'));
    }

    /**
     * Memperbarui data mata kuliah di database.
     */
    public function update(Request $request, MataKuliah $matakuliah)
    {
        $request->validate([
            'nama_mk' => 'required|string|max:255',
            'kode_mk' => 'required|string|max:10|unique:mata_kuliahs,kode_mk,' . $matakuliah->id,
            'bobot_sks' => 'required|integer|min:1',
            'sks_kuliah' => 'required|integer|min:0',
            'sks_seminar' => 'required|integer|min:0',
            'sks_praktek' => 'required|integer|min:0',
        ]);

        $matakuliah->update($request->all());

        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    /**
     * Menghapus mata kuliah dari database.
     */
    public function destroy(MataKuliah $matakuliah)
    {
        $matakuliah->delete();
        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}