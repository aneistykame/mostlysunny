<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;

class ProductController extends Controller
{
    
    public function home()
    {
        //nacitanie 5 produktov z DB
        $products = Product::take(5)->get();
        
        return view('index', compact('products'));
    }

    //zobrazovanie produktov
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'ILIKE', "%{$search}%")
                ->orWhere('description', 'ILIKE', "%{$search}%");
            });
            $category = $search; //nazov kategorie bude zadaný searchom
        } else {
            $category = "Všetky produkty";
        }

        $products = $query->get();

        //vypisanie kategorie a produktov
        return view('category', compact('products', 'category'));
    }
        
    public function category(Request $request, $category)
    {
        $query = Product::where('category', $category);

        //search v rámci kategórie
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'ILIKE', "%{$search}%")
                  ->orWhere('description', 'ILIKE', "%{$search}%");
            });
        }

        $products = $query->get();
        return view('category', compact('products', 'category'));
    }

    public function show($id)
    {
        //nacitanie produktu z DB
        $product = Product::with('images')->where('id', $id)->firstOrFail();
        return view('product', compact('product'));
    }
}