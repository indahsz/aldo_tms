<?php

namespace App\Exports;

use App\Models\Angkut;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class LaporanAngkutExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping

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
        return Angkut::whereBetween('tgl_masuk', [$this->fromDate, $this->toDate])->get();
    }

    public function headings(): array
    {
        return [
            'Kode Transaksi', 'Tgl Masuk', 'Sopir', 'NIK', 'TLP',
            'Transporter', 'Plat Mobil' , 'Customer' , 'Tanggal SJ', 'No. SJ', 
            'Barang', 'Ket. Masuk', 'Ket. Keluar', 'Safety Check', 'Waktu Masuk', 
            'Waktu Keluar', 'Mulai Muat', 'Akhir Muat'        
        ];
    }


    public function map($item): array
    {
        return [
            $item->kode_trans,
            Carbon::parse($item->tgl_masuk)->format('d-m-Y'),
            $item->sopir_nama,
            $item->sopir_nik,
            $item->sopir_tlp,
            $item->transporter,
            $item->nopol_mobil,
            $item->customer,
            $item->tgl_sj,
            $item->no_sj,
            $item->nama_barang,
            $item->ket_in,
            $item->ket_out,
            $item->safety_check ? 'Lengkap' : 'Tidak Lengkap',
            Carbon::parse($item->waktu_in)->format('d-m-Y H:i:s'),
            Carbon::parse($item->waktu_out)->format('d-m-Y H:i:s'),
            $item->muat_start,
            $item->muat_stop,
        ];
    }
}