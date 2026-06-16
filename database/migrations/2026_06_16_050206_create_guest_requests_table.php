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
        Schema::create('guest_requests', function (Blueprint $table) {
            $table->id();
            $table->string('guest_name'); // Nama tamu yang mengisi anjungan
            $table->text('purpose'); // Kalimat keperluan yang diinput oleh tamu
            // Menyimpan id bidang hasil rekomendasi otomatis sistem
            $table->foreignId('matched_department_id')->nullable()->constrained('departments');
            $table->float('accuracy_score')->default(0); // Nilai akurasi mapping dalam persen (%)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_requests');
    }
};