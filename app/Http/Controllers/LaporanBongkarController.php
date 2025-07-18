<?php

namespace App\Http\Controllers;

use App\Models\Bongkar;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Exports\LaporanBongkarExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanBongkarController extends Controller
{

    public function index(Request $request)
    {
        $fromDate = $request->input('from_date', now()->subMonth()->format('Y-m-d'));
        $toDate = $request->input('to_date', now()->format('Y-m-d'));

        $data = Bongkar::whereBetween('tgl_masuk', [$fromDate, $toDate])->paginate(50);
        $users = User::all();

        return view('aldo_tms.pages.laporan.bongkar', compact('data', 'users'));
    }


    public function exportExcel(request $request)
    {
        $fromDate = $request->input('from_date', now()->submonth()->format('Y-m-d'));
        $toDate = $request->input('to_date', now()->format('Y-m-d'));

        return Excel::download(new LaporanBongkarExport($fromDate, $toDate), 'LaporanBongkar.xlsx');
    }
}
