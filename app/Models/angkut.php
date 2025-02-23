<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ramsey\Uuid\Uuid;

class angkut extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'angkuts';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = ['id', 'tgl_masuk', 'sopir_nama', 'sopir_nik', 'sopir_tlp', 'transporter', 'nopol_mobil', 'customer', 'tgl_sj', 'no_sj', 'nama_barang', 'keterangan','safety_check', 'empty_in', 'empty_out', 'foto_sim', 'foto_dokumen', 'foto_stnk', 'waktu_in', 'waktu_out'];

    public function setID()
    {
        $this->attributes['id'] = (string) Uuid::uuid4();
    }
}
