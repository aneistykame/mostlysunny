<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $products = Product::latest()->get();

        return view('adminindex', compact('products'));
    }
    public function create()
    {
        return view('addProduct');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'category'    => 'required|string',
            'stock'       => 'required|integer|min:0',
            'material'    => 'nullable|string|max:255',
            'color'       => 'nullable|string|max:255',
            'images'      => 'required|array|min:2',
            'images.*'    => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product = Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'category'    => $request->category,
            'stock'       => $request->stock,
            'material'    => $request->material,
            'color'       => $request->color,
        ]);

        foreach ($request->file('images') as $index => $file) {
            $path = 'storage/' . $file->store('products', 'public');
            $product->images()->create([
                'image'   => $path,
                'is_main' => $index === 0,
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Produkt bol pridaný');
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'category'    => 'required|string',
            'stock'       => 'required|integer|min:0',
            'material'    => 'nullable|string|max:255',
            'color'       => 'nullable|string|max:255',
            'images'      => 'nullable|array',
            'images.*'    => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'category'    => $request->category,
            'stock'       => $request->stock,
            'material'    => $request->material,
            'color'       => $request->color,
        ]);

        if ($request->hasFile('images')) {
            $product->images()->delete(); // replace all existing images
            foreach ($request->file('images') as $index => $file) {
                $path = 'storage/' . $file->store('products', 'public');
                $product->images()->create([
                    'image'   => $path,
                    'is_main' => $index === 0,
                ]);
            }
        }

        return redirect()->route('admin.dashboard')->with('success', 'Produkt bol upravený');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('editcurtainproduct', compact('product'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Produkt bol odstránený');
    }
    public function deleteProduct()
    {
        $products = Product::latest()->get();
        return view('deleteProduct', compact('products'));
    }

    public function editProduct()
    {
        $products = Product::latest()->get();
        return view('editProduct', compact('products'));
    }
    public function profile()
    {
        return view('adminprofile');
    }
}
