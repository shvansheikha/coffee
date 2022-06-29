<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(): Factory|View|Application
    {
        $data = DB::table('baskets')
            ->select(
                DB::raw('Date(closed_at) as date'),
                DB::raw('COUNT(closed_at) as total'),
                DB::raw('SUM(total_price) as total_price')
            )
            ->whereNotNull('closed_at')
            ->groupBy('date')
            ->orderByDesc('date')
            ->get();

        return view('home', compact('data'));
    }
}
