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
        Schema::create('bongkars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_trans')->unique();
            $table->string('departement')->nullable();
            $table->date('tgl_masuk');
            $table->string('sopir_nama');
            $table->string('sopir_nik')->nullable();
            $table->string('sopir_tlp')->nullable();
            $table->string('nopol_mobil');
            $table->string('supplier');
            $table->date('tgl_sj');
            $table->string('no_sj');
            $table->string('nama_barang');
            $table->string('ket_in')->nullable();
            $table->string('ket_out')->nullable();
            $table->string('foto_sim')->nullable();
            $table->string('foto_stnk')->nullable();
            $table->string('foto_dokumen')->nullable();
            $table->string('foto_dokumen_k')->nullable();
            $table->string('empty_in');
            $table->string('empty_out')->nullable();
            $table->string('user_created')->nullable();
            $table->string('user_updated')->nullable();
            $table->dateTime('waktu_in')->nullable();
            $table->dateTime('waktu_out')->nullable();
            $table->dateTime('bongkar_start')->nullable();
            $table->dateTime('bongkar_stop')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bongkars');
    }
};
