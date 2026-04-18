<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();

        return Inertia::render('categories/Index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return Inertia::render('categories/Create', [
            // 
        ]);
    }

    public function store(Request $request)
    {
        $category = Category::create($request->all());

        return to_route('categories.index');
    }
}
