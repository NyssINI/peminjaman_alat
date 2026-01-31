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
        Schema::create('alats', function (Blueprint $table) {
            $table->id();
            $table->string('kode_alat')->unique(); 
            $table->string('nama_alat');
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->integer('stok')->default(0); 
            $table->string('kondisi')->default('Baik'); 
            $table->string('status')->default('Tersedia');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Pastikan nama tabel di sini sama dengan up (alats)
        Schema::dropIfExists('alats');
    }
};