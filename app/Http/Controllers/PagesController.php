<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $products = Product::paginate(6);
        // return view('products.index', compact('products'));
        return view('pages.home', compact('products'));
    }

    public function productDetails($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.products.productDetails', compact('product'));
    }
}
