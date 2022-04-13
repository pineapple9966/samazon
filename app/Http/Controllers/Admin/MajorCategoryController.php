<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MajorCategory;
use Illuminate\Http\Request;

class MajorCategoryController extends Controller
{
    public function index()
    {
        $majorCategories = MajorCategory::paginate(10);

        return view('admin.major_categories.index', compact('majorCategories'));
    }

    public function create()
    {
        return view('admin.major_categories.create');
    }

    public function store(Request $request)
    {
        MajorCategory::create($request->all());

        return redirect()->route('admin.major_categories.index');
    }

    public function show(MajorCategory $majorCategory)
    {
        return view('admin.major_categories.show', compact('majorCategory'));
    }

    public function edit(MajorCategory $majorCategory)
    {
        return view('admin.major_categories.edit', compact('majorCategory'));
    }

    public function update(Request $request, MajorCategory $majorCategory)
    {
        $majorCategory->update($request->all());

        return redirect()->route('admin.major_categories.index');
    }

    public function destroy(MajorCategory $majorCategory)
    {
        $majorCategory->delete();

        return redirect()->route('admin.major_categories.index');
    }
}
