<?php

use App\Models\Angkut;
use App\Models\Bongkar;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

if (!function_exists('generateKodeTrans')) {
    function generateKodeTrans()
    {
        // Get the logged-in user's department
        $user = Auth::user();
        $prefix = 'CU'; // Default prefix

        if ($user) {
            if (str_contains($user->departement, 'HPC')) {
                $prefix = 'CUHP';
            } elseif (str_contains($user->departement, 'PT')) {
                $prefix = 'CUPT';
            }
        }

        // Get current date in yyMMdd format
        $datePart = Carbon::now()->format('y') . Carbon::now()->format('m') . Carbon::now()->format('d');

        // Find the last inserted kode_trans for today
        $latestEntry = Angkut::where('kode_trans', 'LIKE', "{$prefix}{$datePart}%")
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
        return "{$prefix}{$datePart}{$sequence}";
    }
}


if (!function_exists('generateKodeTransB')) {
    function generateKodeTransB()
    {
        // Get the logged-in user's department
        $user = Auth::user();
        $prefix = 'SU'; // Default prefix

        if ($user) {
            if (str_contains($user->departement, 'HPC')) {
                $prefix = 'SUHP';
            } elseif (str_contains($user->departement, 'PT')) {
                $prefix = 'SUPT';
            }
        }

        // Get current date in yyMMdd format
        $datePart = Carbon::now()->format('y') . Carbon::now()->format('m') . Carbon::now()->format('d');

        // Find the last inserted kode_trans for today
        $latestEntry = Bongkar::where('kode_trans', 'LIKE', "{$prefix}{$datePart}%")
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
        return "{$prefix}{$datePart}{$sequence}";
    }
}
