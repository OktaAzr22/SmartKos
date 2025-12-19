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
        Schema::create('rekap_kategori_pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekap_bulanan_id')
                ->constrained('rekap_bulanan')
                ->onDelete('cascade');
            $table->unsignedBigInteger('id_kategori');
            $table->integer('jumlah_transaksi'); 
            $table->bigInteger('total_nominal');
            $table->timestamps();
            $table->foreign('id_kategori')
                ->references('id_kategori')
                ->on('kategori_pengeluaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_kategori_pengeluaran');
    }
};
