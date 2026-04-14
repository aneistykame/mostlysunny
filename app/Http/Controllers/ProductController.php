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
            $category = $search;
        } else {
            $category = "Všetky produkty";
        }

        $products = $query->paginate(20)->appends($request->all());
        $colors = collect();
    $materials = collect();

    return view('category', compact('products', 'category', 'colors', 'materials'));
    }
        
    public function category(Request $request, $category)
    {
        $query = Product::with('mainImage')->where('category', $category);

        if ($request->filled('color')) {
            $query->where('color', $request->color);
        }

        if ($request->filled('material')) {
            $query->where('material', $request->material);
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('id', 'asc');
        }

        $colors = Product::where('category', $category)
                    ->whereNotNull('color')
                    ->distinct()
                    ->pluck('color');

        $materials = Product::where('category', $category)
                    ->whereNotNull('material')
                    ->distinct()
                    ->pluck('material');

        $products = $query->paginate(10)->appends($request->all());

        return view('category', compact('products', 'category', 'colors', 'materials'));
    }

    public function show($id)
    {
        //nacitanie produktu z DB
        $product = Product::with('images')->where('id', $id)->firstOrFail();
        return view('product', compact('product'));
    }
}