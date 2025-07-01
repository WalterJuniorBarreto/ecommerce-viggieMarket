<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        $startDate = $request->input('start_date', now()->subMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at')
            ->get();

        $totalSales = $orders->sum('total');
        $orderCount = $orders->count();

        // Datos para gráfico
        $dates = [];
        $salesData = [];
        
        $currentDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);
        
        while ($currentDate <= $endDate) {
            $dateString = $currentDate->format('Y-m-d');
            $dailySales = Order::whereDate('created_at', $dateString)->sum('total');
            
            $dates[] = $currentDate->format('M d');
            $salesData[] = $dailySales;
            
            $currentDate->addDay();
        }

        return view('admin.reports.sales', compact(
            'orders', 'totalSales', 'orderCount', 'dates', 'salesData',
            'startDate', 'endDate'
        ));
    }
}