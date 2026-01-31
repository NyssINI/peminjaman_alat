<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kategori'];

    protected static function booted()
    {
        static::created(function ($kategori) {
            \App\Models\Logaktivitas::catat('TAMBAH KATEGORI', "Menambahkan kategori baru: $kategori->nama_kategori");
        });
        static::updated(function ($kategori) {
            \App\Models\Logaktivitas::catat('EDIT KATEGORI', "Mengubah kategori menjadi: $kategori->nama_kategori");
        });
        static::deleted(function ($kategori) {
            \App\Models\Logaktivitas::catat('HAPUS KATEGORI', "Menghapus kategori: $kategori->nama_kategori");
        });
    }

    public function alats()
    {
        return $this->hasMany(Alat::class, 'kategori_id');
    }
}
