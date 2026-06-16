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
        Schema::create('keywords', function (Blueprint $table) {
            $table->id();
            // Menghubungkan kata kunci ke tabel departments. Jika bidang dihapus, kata kuncinya ikut terhapus.
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->string('keyword_word'); // Kata kuncinya (cth: mutasi, cpns, pelatihan)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keywords');
    }
};