<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'space' => 'required|integer',
            'bandwidth' => 'required',
            'image' => 'required|file',
            'price' => 'required|integer',
            'duration' => 'required|integer',
        ]);


        $product = new Product();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->space = $request->space;
        $product->bandwidth = $request->bandwidth;
        $product->price = $request->price;
        $product->duration = $request->duration;

        $product->image = $request->file('image')->store('images');


        $product->save();

        return redirect()->route('admin.product.index');

    }

    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'space' => 'required|integer',
            'bandwidth' => 'required',
            'image' => 'required|file',
            'price' => 'required|integer',
            'duration' => 'required|integer',
        ]);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->space = $request->space;
        $product->bandwidth = $request->bandwidth;
        $product->price = $request->price;
        $product->duration = $request->duration;

        $product->image = $request->file('image')->store('images');


        $product->save();

        return redirect()->route('admin.product.index');
    }

    public function delete(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.product.index');
    }
}
