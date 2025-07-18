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
            'Kode Transaksi',
            'Tgl Masuk',
            'Departement',
            'Sopir',
            'NIK',
            'TLP',
            'Transporter',
            'Armada',
            'Jenis Mobil',
            'Plat Mobil',
            'Customer',
            'Tanggal SJ',
            'No. SJ',
            'Barang',
            'Ket. Masuk',
            'Ket. Keluar',
            'Safety Check',
            'Waktu Masuk',
            'Waktu Keluar',
            'Waktu Progress',
            'Mulai Muat',
            'Akhir Muat',
            'Waktu Proses'
        ];
    }


    public function map($item): array
{
    // Hitung waktu proses masuk -> keluar
    $waktuProses = '-';
    if ($item->waktu_out && $item->waktu_in) {
        $diff = Carbon::parse($item->waktu_in)->diffInMinutes(Carbon::parse($item->waktu_out));
        $jam = floor($diff / 60);
        $menit = $diff % 60;
        $waktuProses = "{$jam} hours {$menit} minutes";
    }

    // Hitung waktu muat_start -> muat_stop
    $waktuMuat = '-';
    if ($item->muat_start && $item->muat_stop) {
        $diff = Carbon::parse($item->muat_start)->diffInMinutes(Carbon::parse($item->muat_stop));
        $jam = floor($diff / 60);
        $menit = $diff % 60;
        $waktuMuat = "{$jam} hours {$menit} minutes";
    }

    return [
        $item->kode_trans,
        Carbon::parse($item->tgl_masuk)->format('d-m-Y'),
        $item->departement,
        $item->sopir_nama,
        $item->sopir_nik,
        $item->sopir_tlp,
        $item->transporter,
        $item->armada,
        $item->jenis_mobil,
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
        $waktuProses,
        $item->muat_start ? Carbon::parse($item->muat_start)->format('d-m-Y H:i') : '-',
        $item->muat_stop ? Carbon::parse($item->muat_stop)->format('d-m-Y H:i') : '-',
        $waktuMuat,
    ];
}
}
