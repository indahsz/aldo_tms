<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ramsey\Uuid\Uuid;

class bongkar extends Model
{
    //
    use HasFactory, HasUuids;
    protected $table = 'bongkars';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = ['id', 'tgl_masuk', 'sopir_nama', 'sopir_nik', 'sopir_tlp', 'nopol_mobil', 'supplier', 'tgl_sj', 'no_sj', 'nama_barang', 'keterangan', 'foto_sim', 'foto_stnk', 'foto_dokumen', 'empty_in', 'empty_out', 'waktu_in', 'waktu_out'];

    public function setID()
    {
        $this->attributes['id'] = (string) Uuid::uuid4();
    }
}
