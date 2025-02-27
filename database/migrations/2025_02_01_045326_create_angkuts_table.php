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
            $table->string('kode_trans')->nullable();
            $table->string('sopir_nama')->nullable();
            $table->string('sopir_nik')->nullable();
            $table->string('sopir_tlp')->nullable();
<<<<<<< HEAD
            $table->string('transporter');
            $table->string('armada');
            $table->string('nopol_mobil');
=======
            $table->string('transporter')->nullable();
            $table->string('nopol_mobil')->nullable();
>>>>>>> a690ed330e9888b929c01eda5c8387ed32b19d7a
            $table->string('customer')->nullable();
            $table->date('tgl_sj')->nullable();
            $table->string('no_sj')->nullable();
            $table->string('nama_barang')->nullable();
            $table->string('ket_in')->nullable();
            $table->string('ket_out')->nullable();
            $table->string('foto_sim')->nullable();
            $table->string('foto_stnk')->nullable();
            $table->string('foto_dokumen')->nullable();
            $table->string('safety_check');
            $table->string('empty_in')->nullable();
            $table->string('empty_out')->nullable();
            $table->string('user_created')->nullable();
            $table->string('user_updated')->nullable();
            $table->dateTime('waktu_in')->nullable();
            $table->dateTime('waktu_out')->nullable();
            $table->dateTime('muat_start')->nullable();
            $table->dateTime('muat_stop')->nullable();
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
