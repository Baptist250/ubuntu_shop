<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\SaleItem;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf; 

class ReportController extends Controller
{
    // REPORT PAGE
    public function index()
{
    // Today's sales
    $todaySales = Sale::whereDate('created_at', today())
        ->sum('total_amount');

    // Current month revenue
    $monthlyRevenue = Sale::whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->sum('total_amount');

    // Products sold
    $productsSold = \App\Models\SaleItem::sum('quantity');

    // Profit calculation
    $sales = Sale::with('items.product')->get();

    $totalRevenue = 0;
    $totalCost = 0;

    foreach ($sales as $sale) {

        foreach ($sale->items as $item) {

            $revenue = $item->price * $item->quantity;

            $cost = $item->product
                ? $item->product->buying_price * $item->quantity
                : 0;

            $totalRevenue += $revenue;
            $totalCost += $cost;
        }
    }

    $profit = $totalRevenue - $totalCost;

    return view('admin.reports.index', compact(
        'todaySales',
        'monthlyRevenue',
        'profit',
        'productsSold'
    ));
}

    // FILTERED REPORT
    public function filtered(Request $request)
{
    $query = Sale::with('items.product');

    if ($request->filled('from') && $request->filled('to')) {
        $query->whereBetween('created_at', [
            $request->from . ' 00:00:00',
            $request->to . ' 23:59:59'
        ]);
    }

    $sales = $query->latest()->get();

    return view('admin.reports.filtered', compact('sales'));
}

    // PROFIT CALCULATION
    public function profit(Request $request)
    {
        $sales = Sale::with('items.product')->get();

        $totalRevenue = 0;
        $totalCost = 0;

        foreach ($sales as $sale) {
            foreach ($sale->items as $item) {

                $revenue = $item->price * $item->quantity;
                $cost = $item->product->buying_price * $item->quantity;

                $totalRevenue += $revenue;
                $totalCost += $cost;
            }
        }

        $profit = $totalRevenue - $totalCost;

        return view('admin.reports.profit', compact(
            'totalRevenue',
            'totalCost',
            'profit'
        ));
    }

    // TOP PRODUCTS
    public function topProducts()
    {
        $products = Product::withSum('saleItems as total_sold', 'quantity')
            ->orderByDesc('total_sold')
            ->take(10)
            ->get();

        return view('admin.reports.top-products', compact('products'));
    }
    public function daily()
{
    $sales = Sale::whereDate('created_at', today())
        ->orderBy('created_at', 'desc')
        ->get();

    $total = $sales->sum('total_amount'); // <-- THIS fixes your error

    $count = $sales->count();

    return view('admin.reports.daily', compact(
        'sales',
        'total',
        'count'
    ));
}

    public function exportDailyPdf()
    {
        $sales = Sale::whereDate('created_at', today())
            ->orderBy('created_at', 'desc')
            ->get();

        $total = $sales->sum('total_amount');
        $count = $sales->count();

        $pdf = \PDF::loadView('admin.reports.daily-pdf', compact(
            'sales',
            'total',
            'count'
        ));

        return $pdf->download('daily_report_' . Carbon::today()->toDateString() . '.pdf');
    }

}