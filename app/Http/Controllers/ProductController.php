<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('index', compact('products'));
    }
    
    public function category($category)
    {
        $products = Product::where('category', $category)->get();
        return view('category', compact('products', 'category'));
    }

    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('product', compact('product'));
    }
}
