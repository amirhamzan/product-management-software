<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();

        return Inertia::render('products/Index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $categories = Category::latest()->get();

        return Inertia::render('products/Create', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $product = Product::create($request->all());

        return to_route('products.index');
    }

    public function show(Product $product)
    {
        $product->load('category');

        return Inertia::render('products/Show', [
            'product' => $product,
        ]);
    }

    public function edit(Product $product)
    {
        $categories = Category::latest()->get();

        return Inertia::render('products/Edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        return to_route('products.show', $product);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return to_route('products.index')->with('flash.banner', 'The item successfully deleted!');
    }
}
