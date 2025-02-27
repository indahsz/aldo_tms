<?php

namespace App\Http\Controllers;

use App\Models\angkut;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class LaporanAngkutController extends Controller
{
    public function index()
    {
        $data = Angkut::paginate(5);
        $users = User::all(); // Fetch all users
        return view('aldo_tms.pages.laporan.angkut', compact('data', 'users'));
    }
}