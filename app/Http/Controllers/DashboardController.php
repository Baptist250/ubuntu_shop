<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // =========================
        // TODAY SALES
        // =========================
        $todaySalesQuery = Sale::whereDate('created_at', now());

        $todayRevenue = (clone $todaySalesQuery)->sum('total_amount');
        $todaySalesCount = (clone $todaySalesQuery)->count();

        // =========================
        // MONTHLY SALES (FIXED YEAR BUG)
        // =========================
        $monthlySalesQuery = Sale::whereMonth('created_at', now()->month)
                                ->whereYear('created_at', now()->year);

        $monthlyRevenue = (clone $monthlySalesQuery)->sum('total_amount');

        // =========================
        // TOTAL SALES
        // =========================
        $totalSales = Sale::count();

        // =========================
        // LOW STOCK PRODUCTS
        // =========================
        $lowStockProducts = Product::where('quantity', '<=', 5)->get();
        $lowStockCount = $lowStockProducts->count();

        // =========================
        // TOTAL PRODUCTS
        // =========================
        $totalProducts = Product::count();

        // =========================
        // RECENT SALES (SAFE ORDER)
        // =========================
        $recentSales = Sale::orderBy('created_at', 'desc')
                          ->take(5)
                          ->get();

        // =========================
        // TOP SELLING PRODUCTS
        // =========================
        $topProducts = SaleItem::select(
                'product_id',
                DB::raw('SUM(quantity) as total_qty')
            )
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->with('product')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'todayRevenue',
            'todaySalesCount',
            'monthlyRevenue',
            'totalSales',
            'lowStockProducts',
            'lowStockCount',
            'totalProducts',
            'recentSales',
            'topProducts'
        ));
    }
}