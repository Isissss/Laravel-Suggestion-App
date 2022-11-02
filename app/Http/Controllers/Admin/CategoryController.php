<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.admin-dashboard', [
            'categories' => Category::withCount('posts')->get(),
            'webtitle' => 'Suggestions',
        ]);
    }

    public function store(Request $request)
    {
        $category = $request->validate([
            'active' => 'boolean',
            'name' => 'required|string|max:50|unique:categories',
            'color' => 'required|string'
        ]);
        Category::create($category);

        return redirect(route('categories.index'))->with('message', 'Category has been created');
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Category $category, Request $request)
    {
        $edit = $request->validate([
            'name' => ['string', 'max:50', Rule::unique('categories', 'name')->ignore($category)],
            'color' => ['string', 'max:10']
        ]);

        $category->update($edit);

        return redirect(route('categories.index'));
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect(route('categories.index'))->with('message', 'Category has been deleted');
    }

    public function updateVisibility(Request $request, Category $category)
    {
        $validated = $request->validate([
            'active' => 'required|boolean',
        ]);

        $category->update($validated);
    }
}
