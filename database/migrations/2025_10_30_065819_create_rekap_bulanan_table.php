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
            $table->id('id_rekap');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('bulan', 20);
            $table->year('tahun');
            $table->decimal('total_pemasukan', 12, 2)->default(0);
            $table->decimal('total_pengeluaran', 12, 2)->default(0);
            $table->decimal('saldo_akhir', 12, 2)->default(0);
            $table->timestamps();
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
