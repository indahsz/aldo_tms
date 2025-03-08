<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ramsey\Uuid\Uuid;

class Departement extends Model
{
    //
    use HasFactory, HasUuids;

    protected $table = 'departements';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = ['id', 'name_departement', 'slug_departement'];

    public function setID()
    {
        $this->attributes['id'] = (string) Uuid::uuid4();
    }
}
