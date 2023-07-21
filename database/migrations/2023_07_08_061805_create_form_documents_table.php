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
        Schema::create('form_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('shift');
            $table->date('tgl_pemeriksaan');
            $table->string('no_polisi');
            $table->integer('fuel');
            $table->integer('km_awal');
            $table->string('pertanyaan_1');
            $table->string('keterangan_1')->nullable();
            $table->string('pertanyaan_2');
            $table->string('keterangan_2')->nullable();
            $table->string('pertanyaan_3');
            $table->string('keterangan_3')->nullable();
            $table->string('pertanyaan_4');
            $table->string('keterangan_4')->nullable();
            $table->string('pertanyaan_5');
            $table->string('keterangan_5')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_documents');
    }
};
