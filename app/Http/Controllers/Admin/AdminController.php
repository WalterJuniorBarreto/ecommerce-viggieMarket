<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Estadísticas para el dashboard
        $todaySales = Order::whereDate('created_at', today())->sum('total');
        $todayOrders = Order::whereDate('created_at', today())->count();
        
        $monthlySales = Order::whereMonth('created_at', now()->month)->sum('total');
        $monthlyOrders = Order::whereMonth('created_at', now()->month)->count();
        
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        
        $totalUsers = User::count();
        $newUsers = User::whereMonth('created_at', now()->month)->count();
        
        // Datos para gráficos
        $monthlyLabels = [];
        $monthlyData = [];
        
        for ($i = 1; $i <= 12; $i++) {
            $monthlyLabels[] = Carbon::create()->month($i)->format('F');
            $monthlyData[] = Order::whereMonth('created_at', $i)
                                ->whereYear('created_at', now()->year)
                                ->sum('total');
        }
        
        // Productos más vendidos
        $topProducts = Product::withCount('orderItems')
            ->orderBy('order_items_count', 'desc')
            ->take(5)
            ->get();
            
        $topProductsLabels = $topProducts->pluck('name');
        $topProductsData = $topProducts->pluck('order_items_count');
        
        // Órdenes recientes
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('dashboard', compact(
            'todaySales', 'todayOrders', 'monthlySales', 'monthlyOrders',
            'totalProducts', 'activeProducts', 'totalUsers', 'newUsers',
            'monthlyLabels', 'monthlyData', 'topProductsLabels', 'topProductsData',
            'recentOrders'
        ));
    }
}