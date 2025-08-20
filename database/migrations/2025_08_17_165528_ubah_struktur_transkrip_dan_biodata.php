<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Ubah kolom user_id di tabel biodatas menjadi nullable
        Schema::table('biodatas', function (Blueprint $table) {
            // Langsung ubah kolomnya. Doctrine (dbal) akan menangani index/key yang ada jika diperlukan.
            // Tidak perlu drop foreign key secara manual jika kita tidak yakin ada.
            $table->foreignId('user_id')->nullable()->change();
        });
    
        // 2. Hapus user_id dan tambahkan biodata_id di tabel transkrips
        Schema::table('transkrips', function (Blueprint $table) {
            // Gunakan cara ini yang lebih aman. 
            // Perintah ini akan otomatis menghapus foreign key constraint-nya dulu baru menghapus kolomnya.
            $table->dropConstrainedForeignId('user_id');
    
            $table->foreignId('biodata_id')->after('id')->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        // Logika untuk membatalkan migrasi (rollback)
        Schema::table('transkrips', function (Blueprint $table) {
            $table->dropForeign(['biodata_id']);
            $table->dropColumn('biodata_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });

        Schema::table('biodatas', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            // Perhatian: Mengembalikan ke not nullable bisa error jika ada data null
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }
};