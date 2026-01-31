<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // WAJIB TAMBAHKAN INI

class Peminjam extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'alat_id',
        'nama_peminjam',
        'tgl_pinjam',
        'tgl_kembali',
        'tgl_kembali_asli',
        'denda',
        'status',
    ];

    protected static function booted()
    {
        static::created(function ($peminjam) {
            $namaAlat = $peminjam->alat->nama_alat ?? 'Alat';
            \App\Models\Logaktivitas::catat('PENGAJUAN', "Mengajukan pinjaman alat: $namaAlat");
        });

        static::updated(function ($peminjam) {
            if ($peminjam->status == 'disetujui') {
                \App\Models\Logaktivitas::catat('PERSETUJUAN', "Menyetujui pinjaman untuk user: $peminjam->nama_peminjam");
            }
            if ($peminjam->status == 'dikembalikan') {
                \App\Models\Logaktivitas::catat('PENGEMBALIAN', "Mengonfirmasi pengembalian alat");
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function alat(): BelongsTo
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }
}
