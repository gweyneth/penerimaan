<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kode_akses', function (Blueprint $table) {
            // Tambahkan kolom status dengan nilai default 'Belum Diproses'
            $table->enum('status_kelulusan', ['Lolos', 'Tidak Lolos', 'Belum Diproses'])
                  ->default('Belum Diproses')
                  ->after('kode'); // Letakkan setelah kolom 'kode'
        });
    }

    public function down(): void
    {
        Schema::table('kode_akses', function (Blueprint $table) {
            // Hapus kolom jika migrasi di-rollback
            $table->dropColumn('status_kelulusan');
        });
    }
};
