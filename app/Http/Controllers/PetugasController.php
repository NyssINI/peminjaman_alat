<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use App\Models\Alat;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PetugasController extends Controller
{
    public function index()
    {
        $datapeminjaman = Peminjam::with('alat')->latest()->get();
        return view('petugas.index', compact('datapeminjaman'));
    }

    public function update(Request $request, $id)
    {
        $pinjam = Peminjam::findOrFail($id);

        if ($request->aksi == 'kembali') {
            $sekarang = $request->jam_petugas
                ? \Carbon\Carbon::parse($request->jam_petugas, 'Asia/Makassar')
                : \Carbon\Carbon::now('Asia/Makassar');
            $nilaiDenda = (int) $request->denda;

            $pinjam->update([
                'status' => 'dikembalikan',
                'tgl_kembali_asli' => $sekarang,
                'denda' => $nilaiDenda
            ]);

            $alat = Alat::find($pinjam->alat_id);
            if ($alat) {
                $alat->update(['status' => 'Tersedia']);
            }

            $pesan = $nilaiDenda > 0
                ? "Alat dikembalikan pukul " . $sekarang->format('H:i') . " dengan denda Rp " . number_format($nilaiDenda)
                : "Alat dikembalikan tepat waktu pada pukul " . $sekarang->format('H:i') . " (Tanpa Denda).";

            return redirect()->back()->with('success', $pesan);
        } else {
            $pinjam->status = $request->status;
            $pinjam->save();

            if ($request->status === 'disetujui') {
                $alat = Alat::find($pinjam->alat_id);
                if ($alat) {
                    $alat->update(['status' => 'Dipinjam']);
                }
            } elseif ($request->status === 'ditolak') {
                $alat = Alat::find($pinjam->alat_id);
                if ($alat) {
                    $alat->update(['status' => 'Tersedia']);
                }
            }

            return redirect()->back()->with('success', 'Status peminjaman berhasil diperbarui!');
        }
    }
}
