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
        Schema::create('absensi', function (Blueprint $table) {
            $table->string('id_absensi')->primary();
            $table->string('id_pengawas');
            $table->foreign('id_pengawas')->references('id_pengawas')->on('pengawas');
            $table->string('id_sift');
            $table->foreign('id_sift')->references('id_sift')->on('sift');
            $table->string('name_kapal');
            $table->string('dermaga');
            $table->string('tgl');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
