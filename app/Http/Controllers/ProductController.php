<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10); // Adjust the number of products per page as needed
        return view('auth.products.index', compact('products'));
    }

    public function create()
    {
        return view('auth.products.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('assets/img/bg-img'), $imageName);

        Product::create([
            'image' => $imageName,
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('auth.products.form', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // dd($request)->all();
        
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image && file_exists(public_path('/assets/img/bg-img/' . $product->image))) {
                unlink(public_path('/assets/img/bg-img/' . $product->image));
            }

            // Store the new image
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('assets/img/bg-img'), $imageName);
            $product->image = $imageName;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Delete the image if it exists
        if ($product->image && file_exists(public_path('assets/img/product-img/' . $product->image))) {
            unlink(public_path('assets/img/product-img/' . $product->image));
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}