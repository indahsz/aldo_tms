<?php

use App\Models\Angkut;
use App\Models\Bongkar;
use Carbon\Carbon;

if (!function_exists('generateKodeTrans')) {
    function generateKodeTrans()
    {
        // Get current date in yyMMdd format
        $datePart = Carbon::now()->format('y') . Carbon::now()->format('m') . Carbon::now()->format('d');

        // Find the last inserted kode_trans for today
        $latestEntry = Angkut::where('kode_trans', 'LIKE', "CU{$datePart}%")
            ->orderBy('kode_trans', 'desc')
            ->first();

        // Extract the last sequence number
        $nextNumber = 1;
        if ($latestEntry) {
            $lastNumber = (int)substr($latestEntry->kode_trans, -3); // Get last 3 digits
            $nextNumber = $lastNumber + 1;
        }

        // Format with leading zeros (001, 002, ...)
        $sequence = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Generate the final kode_trans
        return "CU{$datePart}{$sequence}";
    }
}

if (!function_exists('generateKodeTransB')) {
    function generateKodeTransB()
    {
        // Get current date in yyMMdd format
        $datePart = Carbon::now()->format('y') . Carbon::now()->format('m') . Carbon::now()->format('d');

        // Find the last inserted kode_trans for today
        $latestEntry = Bongkar::where('kode_trans', 'LIKE', "SU{$datePart}%")
            ->orderBy('kode_trans', 'desc')
            ->first();

        // Extract the last sequence number
        $nextNumber = 1;
        if ($latestEntry) {
            $lastNumber = (int)substr($latestEntry->kode_trans, -3); // Get last 3 digits
            $nextNumber = $lastNumber + 1;
        }

        // Format with leading zeros (001, 002, ...)
        $sequence = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Generate the final kode_trans
        return "SU{$datePart}{$sequence}";
    }
}
