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
        Schema::create('detail_absensi', function (Blueprint $table) {
            $table->string('id_absensi');
            $table->foreign('id_absensi')->references('id_absensi')->on('absensi');
            $table->string('id_karyawan');
            $table->foreign('id_karyawan')->references('id_karyawan')->on('karyawan');
            $table->string('id_sift');
            $table->foreign('id_sift')->references('id_sift')->on('sift');
            $table->string('name_kapal');
            $table->string('dermaga');
            $table->string('waktu_absen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_absensi');
    }
};
