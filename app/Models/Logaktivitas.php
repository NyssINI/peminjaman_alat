<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Logaktivitas extends Model
{
    protected $table = 'logaktivitas';
    protected $fillable = ['user_id', 'peran', 'aksi', 'deskripsi', 'alamat_ip'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function catat($aksi, $deskripsi, $userId = null)
    {
        try {
            return self::create([
                'user_id'   => $userId ?? auth()->id(),
                'peran'     => auth()->user()->role ?? 'Guest/Registrant',
                'aksi'      => $aksi,
                'deskripsi' => $deskripsi,
                'alamat_ip' => request()->ip(),
            ]);
        } catch (\Exception $e) {
            return null;
        }
    }
}
