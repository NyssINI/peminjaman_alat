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
        ]);

        $userId = auth()->id();
        
        $cekAntrean = Peminjam::where('alat_id', $request->alat_id)
            ->whereIn('status', ['pending', 'disetujui'])
            ->first();

        if ($cekAntrean) {
            if ($cekAntrean->user_id == $userId) {
                return redirect()->back()->with('info', "Anda sudah mengajukan peminjaman untuk alat ini. Silakan tunggu konfirmasi.");
            }
            return redirect()->back()->with('warning', "Maaf, alat ini sudah dipesan/dipakai oleh {$cekAntrean->nama_peminjam}. Pilih alat lain.");
        }
        Peminjam::create([
            'user_id' => $userId,
            'alat_id' => $request->alat_id,
            'nama_peminjam' => auth()->user()->name,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali,
            'status' => 'pending',
        ]);

        return redirect()->route('peminjam.index')->with('success', 'Permintaan peminjaman berhasil dikirim!');
    }
}
