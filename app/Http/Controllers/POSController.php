<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class POSController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.pos.index', compact('products'));
    }


   public function checkout(Request $request)
{
    $request->validate([
        'cart' => 'required|string',
        'customer_name' => 'required|string|max:255',
        'customer_phone' => 'nullable|string|max:100',
        'customer_email' => 'nullable|email|max:255',
        'customer_address' => 'nullable|string|max:500',
    ]);

    $cart = json_decode($request->cart, true);

    if (!$cart || count($cart) === 0) {
        return back()->with('error', 'Cart is empty');
    }

    DB::beginTransaction();

    try {

        foreach ($cart as $item) {
            $product = Product::find($item['id']);

            if (!$product) {
                throw new \Exception("Product not found");
            }

            if ($product->quantity < $item['qty']) {
                throw new \Exception("Insufficient stock for {$product->name}");
            }

            // Record OUT movement in inventory ledger
            $oldQty = (int) $product->quantity;
            $newQty = (int) ($product->quantity - $item['qty']);

            $product->quantity = $newQty;
            $product->save();

            \App\Models\InventoryChange::create([
                'product_id' => $product->id,
                'user_id' => $request->user()?->id,
                'old_quantity' => $oldQty,
                'new_quantity' => $newQty,
                'change' => $item['qty'],
                'type' => 'sale',
                'note' => 'POS checkout',
            ]);
        }

        // Generate a unique invoice number
        $invoiceNumber = 'INV-' . strtoupper(uniqid());

        $sale = Sale::create([
            'total_amount' => collect($cart)->sum(fn($i) => $i['price'] * $i['qty']),
            'customer_name' => $request->input('customer_name'),
            'customer_phone' => $request->input('customer_phone'),
            'customer_email' => $request->input('customer_email'),
            'customer_address' => $request->input('customer_address'),
            'cashier_id' => $request->user()?->id,
            'invoice_number' => $invoiceNumber,
        ]);

        // Create SaleItem records for each item in cart
        foreach ($cart as $item) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
            ]);
        }

        // NOTE: Inventory OUT ledger rows are already created above per product item.


        DB::commit();

        return redirect()
            ->back()
            ->with('success', 'Sale completed successfully');

    } catch (\Exception $e) {
        DB::rollBack();

        return back()->with('error', $e->getMessage());
    }
}


}
