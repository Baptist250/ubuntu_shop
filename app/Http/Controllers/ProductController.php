<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('admin.products.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'existing_product_id' => 'nullable|exists:products,id',
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'buying_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')
                ->store('products', 'public');
        }

        if ($request->filled('existing_product_id')) {
            $product = Product::findOrFail($request->existing_product_id);
            $product->name = $request->name;
            $product->brand = $request->brand;
            $product->description = $request->description;
            $product->buying_price = str_replace(',', '', $request->buying_price);
            $product->selling_price = str_replace(',', '', $request->selling_price);
            $product->quantity = $request->quantity;

            if ($request->hasFile('image')) {
                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }
                $product->image = $request->file('image')->store('products', 'public');
            }

            $product->save();

            return redirect()
                ->route('products.index')
                ->with('success', 'Existing product updated successfully.');
        }

        Product::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'description' => $request->description,
            'buying_price' => str_replace(',', '', $request->buying_price),
            'selling_price' => str_replace(',', '', $request->selling_price),
            'quantity' => $request->quantity,
            'image' => $imagePath
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product added successfully.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'buying_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $product = Product::findOrFail($id);

        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->description = $request->description;
        $product->buying_price = str_replace(',', '', $request->buying_price);
        $product->selling_price = str_replace(',', '', $request->selling_price);
        $product->quantity = $request->quantity;

        if ($request->hasFile('image')) {

            if (
                $product->image &&
                Storage::disk('public')->exists($product->image)
            ) {
                Storage::disk('public')->delete($product->image);
            }

            $product->image = $request
                ->file('image')
                ->store('products', 'public');
        }

        $product->save();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if (
            $product->image &&
            Storage::disk('public')->exists($product->image)
        ) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}