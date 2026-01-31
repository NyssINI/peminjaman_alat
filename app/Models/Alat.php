<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_alat',
        'nama_alat',
        'kategori_id',
        'stok',
        'kondisi',
        'status',
        'deskripsi'
    ];

    protected static function booted()
    {
        static::created(function ($alat) {
            \App\Models\Logaktivitas::catat('TAMBAH ALAT', "Menambahkan alat baru: $alat->nama_alat (Kode: $alat->kode_alat)");
        });
        static::updated(function ($alat) {
            if ($alat->isDirty(['status', 'stok']) && !$alat->isDirty(['nama_alat', 'kode_alat', 'deskripsi'])) {
                return;
            }
            \App\Models\Logaktivitas::catat('EDIT ALAT', "Mengubah informasi utama alat: $alat->nama_alat");
        });
        static::deleted(function ($alat) {
            \App\Models\Logaktivitas::catat('HAPUS ALAT', "Menghapus alat: $alat->nama_alat");
        });
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
