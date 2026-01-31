<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('alat_id')->constrained('alats')->onDelete('cascade');
            $table->string('nama_peminjam');
            $table->datetime('tgl_pinjam');
            $table->datetime('tgl_kembali')->nullable();
            $table->dateTime('tgl_kembali_asli')->nullable(); 
            $table->integer('denda')->default(0);
            $table->enum('status', ['pending', 'disetujui', 'ditolak', 'dikembalikan'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjams');
    }
};
