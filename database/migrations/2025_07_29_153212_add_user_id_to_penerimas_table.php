<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penerimas', function (Blueprint $table) {
            // Tambahkan kolom user_id setelah kolom id
            $table->foreignId('user_id')
                  ->nullable() // Boleh kosong, karena akun dibuat belakangan
                  ->unique()   // Satu penerima hanya bisa punya satu akun
                  ->after('id')
                  ->constrained('users') // Merujuk ke tabel 'users'
                  ->onDelete('set null'); // Jika user dihapus, user_id di penerima jadi null
        });
    }

    public function down(): void
    {
        Schema::table('penerimas', function (Blueprint $table) {
            // Hapus foreign key constraint sebelum menghapus kolom
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
