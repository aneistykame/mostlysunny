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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');
        Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category' => $validated['category'],
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Produkt bol pridaný');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('editProduct', compact('product'));
    }
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }
        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->category = $validated['category'];

        $product->save();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Produkt bol upravený');
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
}
