<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Fetch user data
        $user = auth()->user();
        return view('index', ['user' => $user]);
    }

    public function customerCount()
    {
        // Get the count of users
        $userCount = DB::table('users')->count();

        // Pass the user count to the view
        return view('index', ['userCount' => $userCount]);
    }
}
