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
        Schema::create('form_tools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('shift');
            $table->date('tgl_pemeriksaan');
            $table->string('no_polisi');
            $table->string('pertanyaan_36');
            $table->string('keterangan_36')->nullable();
            $table->string('pertanyaan_37');
            $table->string('keterangan_37')->nullable();
            $table->string('pertanyaan_38');
            $table->string('keterangan_38')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_tools');
    }
};
