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
        Schema::create('report_forms', function (Blueprint $table) {
            $table->id();
            $table->string('id_driver');
            $table->string('nama_driver');
            $table->string('shift');
            $table->string('no_polisi');
            $table->string('tanggal_input');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_forms');
    }
};
