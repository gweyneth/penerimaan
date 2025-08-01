<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kode_akses', function (Blueprint $table) {
            $table->id();

            // Kunci asing ke tabel penerimas
            $table->foreignId('penerima_id')
                  ->unique() // Satu penerima hanya punya satu kode akses
                  ->constrained('penerimas') // Merujuk ke tabel 'penerimas'
                  ->onDelete('cascade'); // Jika penerima dihapus, kode aksesnya ikut terhapus

            $table->string('kode')->unique(); // Kode akses harus unik
            $table->date('tanggal_kadaluarsa');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kode_akses');
    }
};
