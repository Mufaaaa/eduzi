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
        Schema::create('hasil_kalkulator', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_anak')
                  ->constrained('data_anak')
                  ->cascadeOnDelete();

            $table->string('hasil_prediksi');
            $table->text('penjelasan');
            $table->text('rekomendasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_kalkulator');
    }
};
