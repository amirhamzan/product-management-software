<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $sortField = $request->input('sort_by', 'id');
        $direction = $request->input('direction', 'desc');

        $categories = Category::orderBy($sortField, $direction)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('categories/Index', [
            'categories' => $categories,
            'filters' => $request->only(['sort_by', 'direction']),
        ]);
    }

    public function create()
    {
        return Inertia::render('categories/Create', [
            // 
        ]);
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return to_route('categories.show', $category);
    }

    public function show(Category $category)
    {
        return Inertia::render('categories/Show', [
            'category' => $category,
        ]);
    }

    public function edit(Category $category)
    {
        return Inertia::render('categories/Edit', [
            'category' => $category,
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return to_route('categories.show', $category);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return to_route('categories.index')->with('flash.banner', 'The item successfully deleted!');
    }
}
