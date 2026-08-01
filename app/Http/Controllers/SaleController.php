<?php

namespace App\Http\Controllers;

use App\Models\Sale;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('items.product')->latest()->get();
        return view('admin.sales.index', compact('sales'));
    }

    public function show($id)
    {
        $sale = Sale::with('items.product')->findOrFail($id);
        return view('admin.sales.show', compact('sale'));
    }

    public function print($id)
    {
        $sale = Sale::with('items.product')->findOrFail($id);
        return view('admin.sales.print', compact('sale'));
    }
}