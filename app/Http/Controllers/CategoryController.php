<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        return view('App.categories.index', [
            'categories' => Category::latest()->filter(request('search'))->paginate(7)
        ]);
    }

    public function create()
    {
        return view('App.categories.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'min:3', Rule::unique('categories', 'name')],
            'description' => ['required', 'string', 'min:5']
        ]);

        Category::create($attributes);

        return redirect()->route('categories');
    }

    public function edit(Category $category)
    {
        return view('App.categories.edit', [
            'category' => $category
        ]);
    }

    public function update(Category $category)
    {
        $attributes = request()->validate([
            'name' => ['required', 'string', 'min:3', Rule::unique('categories', 'name')->ignore($category->id)],
            'description' => ['required', 'string', 'min:5']
        ]);

        $category->update($attributes);

        return redirect()->route('categories');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories');
    }
}
