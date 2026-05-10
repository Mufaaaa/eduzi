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
        Schema::create('data_anak', function (Blueprint $table) {
            $table->id();
            // nullable karena bisa tanpa login
            $table->foreignId('id_user')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
            $table->string('nama_anak');
            $table->enum('jenis_kelamin', [
                'Laki-laki',
                'Perempuan'
            ]);
            $table->integer('umur_bulan');
            $table->float('tinggi_badan');
            $table->float('berat_badan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_anak');
    }
};
