<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
     protected static function booted()
    {
        static::created(function ($user) {
            \App\Models\Logaktivitas::catat('TAMBAH USER', "Menambahkan user baru: $user->name");
        });
        static::updated(function ($user) {
            \App\Models\Logaktivitas::catat('EDIT USER', "Mengubah data user: $user->name");
        });

        static::deleted(function ($user) {
            \App\Models\Logaktivitas::catat('HAPUS USER', "Menghapus user: $user->name");
        });
    }
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
