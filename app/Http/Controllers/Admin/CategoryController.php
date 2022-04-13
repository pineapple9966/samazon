<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MajorCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $majorCategories = MajorCategory::all();

        $categories = Category::paginate(10);

        return view('admin.categories.index', compact('majorCategories', 'categories'));
    }

    public function create()
    {
        $majorCategories = MajorCategory::all();

        return view('admin.categories.create', compact('majorCategories'));
    }

    public function store(Request $request)
    {
        Category::create($request->all());

        return redirect()->route('admin.categories.index');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $majorCategories = MajorCategory::all();

        return view('admin.categories.edit', compact('category', 'majorCategories'));
    }

    public function update(Request $request, Category $category)
    {
        $category->update($request->all());

        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index');
    }
}
