<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CetakLaporan;

class CetakLaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = CetakLaporan::with(['alat']);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tgl_pinjam', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        $data = $query->latest()->get();

        return view('cetaklaporan.index', [
            'data' => $data,
            'start' => $request->start_date ?? 'Semua',
            'end' => $request->end_date ?? 'Waktu'
        ]);
    }
}
