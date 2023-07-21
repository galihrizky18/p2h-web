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
        Schema::create('form_engines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('shift');
            $table->date('tgl_pemeriksaan');
            $table->string('no_polisi');
            $table->string('pertanyaan_27');
            $table->string('keterangan_27')->nullable();
            $table->string('pertanyaan_28');
            $table->string('keterangan_28')->nullable();
            $table->string('pertanyaan_29');
            $table->string('keterangan_29')->nullable();
            $table->string('pertanyaan_30');
            $table->string('keterangan_30')->nullable();
            $table->string('pertanyaan_31');
            $table->string('keterangan_31')->nullable();
            $table->string('pertanyaan_32');
            $table->string('keterangan_32')->nullable();
            $table->string('pertanyaan_33');
            $table->string('keterangan_33')->nullable();
            $table->string('pertanyaan_34');
            $table->string('keterangan_34')->nullable();
            $table->string('pertanyaan_35');
            $table->string('keterangan_35')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_engines');
    }
};
