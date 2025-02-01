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
        Schema::create('tamus', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('id_visitor');
            $table->date('tgl_visit');
            $table->string('nama');
            $table->string('nik');
            $table->string('tlp');
            $table->string('keperluan');
            $table->string('jumlah_tamu');
            $table->string('janji_temu');
            $table->string('keterangan');
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
        Schema::dropIfExists('tamus');
    }
};
