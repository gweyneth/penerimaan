<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan baris ini
            $table->string('role')->default('siswa'); // Menambah kolom 'role' dengan nilai default 'siswa'
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Untuk proses rollback (jika diperlukan)
            $table->dropColumn('role');
        });
    }
};