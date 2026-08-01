<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\InventoryChange;
use Illuminate\Http\Request;
use App\Services\CloudinaryService;

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


public function store(Request $request, CloudinaryService $cloudinary)
{
    $request->validate([
        'name'=>'required|string|max:255',
        'brand'=>'nullable|string|max:255',
        'description'=>'nullable|string',
        'buying_price'=>'required|numeric',
        'selling_price'=>'required|numeric',
        'quantity'=>'required|integer|min:0',
        'image'=>'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);


    $imageUrl = null;


    if($request->hasFile('image')){

        $imageUrl = $cloudinary->upload(
            $request->file('image')
        );

    }


    Product::create([

        'name'=>$request->name,

        'brand'=>$request->brand,

        'description'=>$request->description,

        'buying_price'=>str_replace(',', '', $request->buying_price),

        'selling_price'=>str_replace(',', '', $request->selling_price),

        'quantity'=>$request->quantity,

        'image'=>$imageUrl

    ]);


    return redirect()
        ->route('products.index')
        ->with('success','Product added successfully');

}







    public function edit(Product $product)
    {
        return view('admin.products.edit',compact('product'));
    }






    public function update(Request $request,$id, CloudinaryService $cloudinary)
    {


        $request->validate([

            'name'=>'required|string|max:255',

            'brand'=>'nullable|string|max:255',

            'buying_price'=>'required|numeric',

            'selling_price'=>'required|numeric',

            'quantity'=>'required|integer|min:0',

            'image'=>'nullable|image|mimes:jpg,jpeg,png|max:2048'

        ]);



        $product = Product::findOrFail($id);


        $oldQty = $product->quantity;



        $product->name=$request->name;

        $product->brand=$request->brand;

        $product->description=$request->description;

        $product->buying_price=str_replace(',','',$request->buying_price);

        $product->selling_price=str_replace(',','',$request->selling_price);

        $product->quantity=$request->quantity;




        if($request->hasFile('image')){

    $product->image = $cloudinary->upload(
        $request->file('image')
    );

}



        $product->save();





        return redirect()
        ->route('products.index')
        ->with(
            'success',
            'Product updated successfully.'
        );

    }






    public function destroy(Product $product)
{
    $product->delete();

    return redirect()
        ->route('products.index')
        ->with(
            'success',
            'Product deleted successfully.'
        );
}

    }


}
