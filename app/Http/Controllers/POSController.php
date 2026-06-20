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

            $product->quantity -= $item['qty'];
            $product->save();
        }

        $sale = Sale::create([
            'total_amount' => collect($cart)->sum(fn($i) => $i['price'] * $i['qty']),
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
