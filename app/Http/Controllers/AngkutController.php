<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AngkutController extends Controller
{
    public function index()
    {
        return view('aldo_tms/pages/angkut/angkut');
    }
}
