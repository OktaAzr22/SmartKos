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
        Schema::create('rekap_bulanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  
            $table->unsignedTinyInteger('bulan');     // 1 - 12
            $table->unsignedSmallInteger('tahun');    // 2024, 2025, dst
            $table->bigInteger('total_pemasukan')->default(0);
            $table->bigInteger('total_pengeluaran')->default(0);
            $table->bigInteger('saldo_awal')->default(0);
            $table->bigInteger('saldo_akhir')->default(0);
            $table->boolean('is_printed')->default(false);
            $table->string('pdf_path')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'bulan', 'tahun']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_bulanan');
    }
};
