<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function getChartData()
    {
        $dates = [];
        $prices = [];
        $startDate = Carbon::now()->subDays(365); // Ambil data 365 hari terakhir

        for ($i = 0; $i < 365; $i++) {
            $dates[] = $startDate->copy()->addDays($i)->format('Y-m-d');
            $prices[] = round(rand(1800, 2000) + mt_rand() / mt_getrandmax(), 2); // Pastikan float
        }

        return response()->json([
            'dates' => $dates,
            'prices' => $prices,
        ], 200, [], JSON_NUMERIC_CHECK); // Paksa JSON dalam bentuk angka
        
    }
}
