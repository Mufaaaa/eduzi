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
        Schema::create('like_komunitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('komunitas_id')->nullable()
                  ->constrained('komunitas')->cascadeOnDelete();
            $table->foreignId('komentar_id')->nullable()
                  ->constrained('komentar_komunitas')->cascadeOnDelete();

            $table->string('guest_identifier')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('like_komunitas');
    }
};
