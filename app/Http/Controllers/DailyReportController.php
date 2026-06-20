<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class DailyReportController extends Controller
{
    public function index()
    {
        // Get today's sales WITH their items and products
        $sales = Sale::with('items.product')
            ->whereDate('created_at', today())
            ->latest()
            ->get();

        // Calculate total revenue
        $total = $sales->sum('total_amount');

        return view('admin.reports.daily', compact('sales', 'total'));
    }
}