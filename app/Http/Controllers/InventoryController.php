<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        return view('admin.inventory.index', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0'
        ]);

        $product = Product::findOrFail($id);

        $oldQty = $product->quantity;

        $product->quantity = $request->quantity;
        $product->save();

        // THIS IS YOUR "LEDGER ENTRY POINT"
        // later you can add:
        // InventoryLog::create([
        //     'product_id' => $product->id,
        //     'old_qty' => $oldQty,
        //     'new_qty' => $request->quantity,
        // ]);

        return back()->with('success',
            "Stock updated: {$product->name} ({$oldQty} → {$request->quantity})"
        );
    }
}