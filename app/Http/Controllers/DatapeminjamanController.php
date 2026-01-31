<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use Illuminate\Http\Request;

class DatapeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjam::with(['user', 'alat']);

        if ($request->filled('start_date')) {
            $query->whereDate('tgl_pinjam', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tgl_pinjam', '<=', $request->end_date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $datapeminjaman = $query->latest()->get();

        return view('datapeminjaman.index', compact('datapeminjaman'));
    }

    public function destroy($id)
    {
        $peminjaman = Peminjam::findOrFail($id);
        $peminjaman->delete();
        return redirect()->back()->with('success', 'Data peminjaman berhasil dihapus permanent.');
    }
}
