<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $jmlUser = DB::table('users')->count();
        $jmlProduct = DB::table('products')->count();
        $jmlOrder = DB::table('orders')->count();
        $totalOrder = DB::table('orders')
    ->whereDate('transaction_time', Carbon::today())
    ->sum('total');

        return view('pages.dashboard', compact('jmlUser', 'jmlProduct', 'jmlOrder', 'totalOrder'));
    }
}
