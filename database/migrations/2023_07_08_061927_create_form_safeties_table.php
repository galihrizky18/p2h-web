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
        Schema::create('form_safeties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('shift');
            $table->date('tgl_pemeriksaan');
            $table->string('no_polisi');
            $table->string('pertanyaan_6');
            $table->string('keterangan_6')->nullable();
            $table->string('pertanyaan_7');
            $table->string('keterangan_7')->nullable();
            $table->string('pertanyaan_8');
            $table->string('keterangan_8')->nullable();
            $table->string('pertanyaan_9');
            $table->string('keterangan_9')->nullable();
            $table->string('pertanyaan_10');
            $table->string('keterangan_10')->nullable();
            $table->string('pertanyaan_11');
            $table->string('keterangan_11')->nullable();
            $table->string('pertanyaan_12');
            $table->string('keterangan_12')->nullable();
            $table->string('pertanyaan_13');
            $table->string('keterangan_13')->nullable();
            $table->string('pertanyaan_14');
            $table->string('keterangan_14')->nullable();
            $table->string('pertanyaan_15');
            $table->string('keterangan_15')->nullable();
            $table->string('pertanyaan_16');
            $table->string('keterangan_16')->nullable();
            $table->string('pertanyaan_17');
            $table->string('keterangan_17')->nullable();
            $table->string('pertanyaan_18');
            $table->string('keterangan_18')->nullable();
            $table->string('pertanyaan_19');
            $table->string('keterangan_19')->nullable();
            $table->string('pertanyaan_20');
            $table->string('keterangan_20')->nullable();
            $table->string('pertanyaan_21');
            $table->string('keterangan_21')->nullable();
            $table->string('pertanyaan_22');
            $table->string('keterangan_22')->nullable();
            $table->string('pertanyaan_23');
            $table->string('keterangan_23')->nullable();
            $table->string('pertanyaan_24');
            $table->string('keterangan_24')->nullable();
            $table->string('pertanyaan_25');
            $table->string('keterangan_25')->nullable();
            $table->string('pertanyaan_26');
            $table->string('keterangan_26')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_safeties');
    }
};
