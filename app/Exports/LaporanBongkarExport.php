<?php

namespace App\Exports;

use App\Models\Bongkar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class LaporanBongkarExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping

{
    protected $fromDate;
    protected $toDate;

    public function __construct($fromDate, $toDate)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    public function collection()
    {
        return Bongkar::whereBetween('tgl_masuk', [$this->fromDate, $this->toDate])->get();
    }

    public function headings(): array
    {
        return [
            'Kode Transaksi',
            'Tgl Masuk',
            'Departement',
            'Sopir',
            'NIK',
            'TLP',
            'Plat Mobil',
            'Supplier',
            'Tanggal SJ',
            'No. SJ',
            'Barang',
            'Ket. Masuk',
            'Ket. Keluar',
            'Waktu Masuk',
            'Waktu Keluar',
            'Mulai Bongkar',
            'Selesai Muat'
        ];
    }


    public function map($item): array
    {
        return [
            $item->kode_trans,
            Carbon::parse($item->tgl_masuk)->format('d-m-Y'),
            $item->department,
            $item->sopir_nama,
            $item->sopir_nik,
            $item->sopir_tlp,
            $item->nopol_mobil,
            $item->suuplier,
            $item->tgl_sj,
            $item->no_sj,
            $item->nama_barang,
            $item->ket_in,
            $item->ket_out,
            Carbon::parse($item->waktu_in)->format('d-m-Y H:i:s'),
            Carbon::parse($item->waktu_out)->format('d-m-Y H:i:s'),
            $item->bongkar_start,
            $item->bongkar_stop,
        ];
    }
}
