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
        Schema::create('saldo_user', function (Blueprint $table) {
            $table->id('id_saldo');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->decimal('saldo_awal', 12, 2)->default(0);
            $table->decimal('saldo_sekarang', 12, 2)->default(0);
            $table->string('bulan', 20);
            $table->year('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saldo_user');
    }
};
