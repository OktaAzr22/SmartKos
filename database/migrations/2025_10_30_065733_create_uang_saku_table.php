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
        Schema::create('uang_saku', function (Blueprint $table) {
            $table->id('id_uang_saku');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->decimal('jumlah', 12, 2);
            $table->string('keterangan', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uang_saku');
    }
};
