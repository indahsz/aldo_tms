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
        Schema::create('angkuts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('tgl_masuk');
            $table->string('sopir_nama');
            $table->string('sopir_nik');
            $table->string('sopir_tlp');
            $table->string('transporter');
            $table->string('nopol_mobil');
            $table->string('customer');
            $table->date('tgl_sj');
            $table->string('no_sj');
            $table->string('nama_barang');
            $table->string('keterangan');
            $table->string('foto_sim');
            $table->string('foto_stnk');
            $table->string('foto_dokumen');
            $table->boolean('safety_check');
            $table->boolean('empty_in')->default(false);
            $table->boolean('empty_out')->default(true);
            $table->string('user_created');
            $table->string('user_updated');
            $table->timestamp('waktu_in')->nullable();
            $table->timestamp('waktu_out')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('angkuts');
    }
};
