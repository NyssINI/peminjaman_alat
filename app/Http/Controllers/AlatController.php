<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Logaktivitas;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class AlatController extends Controller
{
    public function index()
    {
        $alat = Alat::with('kategori')->latest()->get();
        return view('alat.index', compact('alat'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('alat.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_alat'   => 'required|unique:alats,kode_alat',
            'nama_alat'   => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'kondisi'     => 'required|in:Baik,Rusak,Perbaikan',
            'stok'        => 'required|numeric|min:0',
            'status'      => 'required',
            'deskripsi'   => 'nullable',
        ]);

        $data = $request->all();    
        Alat::create($data);
        return redirect()->route('alat.index')->with('success', 'Alat baru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $alat = Alat::findOrFail($id);
        $kategoris = Kategori::all();
        return view('alat.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);

        $request->validate([
            'kode_alat'   => 'required|unique:alats,kode_alat,' . $id,
            'nama_alat'   => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'kondisi'     => 'required|in:Baik,Rusak,Perbaikan',
            'stok'        => 'required|numeric|min:0',
            'status'      => 'required',
            'deskripsi'   => 'nullable',
        ]);

        $data = $request->all();
        $alat->update($data);
        return redirect()->route('alat.index')->with('success', 'Data alat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        $alat->delete();
        return redirect()->route('alat.index')->with('success', 'Alat berhasil dihapus!');
    }
}
