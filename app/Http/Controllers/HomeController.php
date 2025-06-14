<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $jmlUser = DB::table('users')->count();
        $jmlProduct = DB::table('products')->count();

        return view('pages.dashboard', compact('jmlUser', 'jmlProduct'));
    }
}
