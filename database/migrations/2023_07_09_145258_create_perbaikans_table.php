<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('perbaikans', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('pending');
            $table->string('id_report');
            $table->string('no_polisi');
            $table->string('nama_driver');
            $table->string('mitra_bengkel');
            $table->date('tanggal_perbaikan');
            $table->date('tanggal_selesai')->nullable();
            $table->string('nota')->nullable();
            $table->decimal('jumlah_pembayaran', 14, 2)->default(0.00);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbaikans');
    }
};
