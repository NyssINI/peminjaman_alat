<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::latest()->get();
        $kategoriEdit = null;
        return view('kategori.index', compact('kategoris', 'kategoriEdit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategoris,nama_kategori|max:255',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi!',
            'nama_kategori.unique' => 'Nama kategori sudah ada, gunakan nama lain.',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    public function edit(Kategori $kategori)
    {
        $kategoris = Kategori::latest()->get();
        $kategoriEdit = $kategori;
        return view('kategori.index', compact('kategoris', 'kategoriEdit'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategoris,nama_kategori,' . $kategori->id . '|max:255',
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
