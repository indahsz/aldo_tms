<?php

namespace App\Exports;

use App\Models\Bongkar;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanBongkarExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Bongkar::all();
    }
}
