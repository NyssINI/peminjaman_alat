<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjam;
use Illuminate\Http\Request;

class PeminjamController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        return view('peminjam.index', [
            'alats' => Alat::where('status', 'Tersedia')->with('kategori')->get(),

            'pinjamanAktif' => Peminjam::where('user_id', $userId)
                ->whereIn('status', ['disetujui', 'pending'])
                ->with('alat')->latest()->get(),

            'riwayatSelesai' => Peminjam::where('user_id', $userId)
                ->whereIn('status', ['dikembalikan', 'ditolak'])
                ->with('alat')->latest()->get(),
        ]);
    }

    public function create(Request $request)
    {
        $alat_id = $request->query('alat_id');
        $alat = Alat::findOrFail($alat_id);

        return view('peminjam.create', compact('alat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date|after:tgl_pinjam',
        ], [
            'tgl_kembali.after' => 'Tanggal & Jam kembali harus lebih besar dari Tanggal & Jam pinjam.',
        ]);

        Peminjam::create([
            'user_id' => auth()->id(),
            'alat_id' => $request->alat_id,
            'nama_peminjam' => auth()->user()->name,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali,
            'status' => 'pending',
        ]);

        return redirect()->route('peminjam.index')->with('success', 'Permintaan peminjaman berhasil dikirim!');
    }
}
