<?php

namespace App\Http\Controllers;

use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(): JsonResponse
    {
        $list = DB::table('baskets')
            ->select(
                DB::raw('Date(closed_at) as date'),
                DB::raw('COUNT(closed_at) as total'),
                DB::raw('SUM(total_price) as total_price')
            )
            ->whereNotNull('closed_at')
            ->groupBy('date')
            ->orderByDesc('date')
            ->get();

        foreach ($list as $item) {
            $item->closed_at = $item->date;
            $item->date = Verta::instance($item->date)->format('Y-m-d');
            $item->total_price = round($item->total_price, 0);
        }

        return response()->json(['data' => $list]);
    }
}
