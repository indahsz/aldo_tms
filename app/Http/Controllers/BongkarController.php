<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BongkarController extends Controller
{
    public function index()
    {
        return view('aldo_tms/pages/bongkar/bongkar');
    }
}
