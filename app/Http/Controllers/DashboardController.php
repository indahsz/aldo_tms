<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $users = User::all(); // Fetch all users
        return view('aldo_tms/pages/dashboard/dashboard' , compact('users'));
    }
    
}
