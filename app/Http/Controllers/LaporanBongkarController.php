<?php

namespace App\Http\Controllers;

use App\Models\bongkar;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class LaporanBongkarController extends Controller
{
    public function index()
    {
        $data = Bongkar::paginate(5);
        $users = User::all(); // Fetch all users
        return view('aldo_tms.pages.laporan.bongkar', compact('data', 'users'));
    }
}
