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

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $orderStats = DB::table('orders')
            ->selectRaw('DAYNAME(transaction_time) as day, SUM(total) as total')
            ->whereBetween('transaction_time', [$startOfWeek, $endOfWeek])
            ->groupBy('day')
            ->get();

        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $dataChart = array_fill_keys($days, 0);

        foreach ($orderStats as $stat) {
            $dataChart[$stat->day] = (int) $stat->total;
        }

        // Pastikan semua int
        $dataChart = array_map('intval', $dataChart);

        return view('pages.dashboard', compact('jmlUser', 'jmlProduct', 'jmlOrder', 'totalOrder', 'dataChart'));
    }
}
