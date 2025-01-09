<?php

namespace App\Http\Controllers\api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'categories' => $categories
        ],200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required','string','min:3',Rule::unique('categories','name')],
            'description' => ['required','min:5']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Unprocessable. Something wrong !'
            ], 422);
        }

        Category::create([
            'name' => request('name'),
            'description' => request('description')
        ]);

        return response()->json([
            'message' => 'New category created successful...'
        ], 200);
    }

    public function update(Category $category)
    {
        $validator = Validator::make(request()->all(), [
            'name' => ['required', 'min:3', Rule::unique('categories', 'name')->ignore($category->id)],
            'description' => ['required', 'min:5']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }

        $category->update([
            'name' => request('name'),
            'description' => request('description')
        ]);

        return response()->json([
            'category' => $category
        ], 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'category deleted...'
        ],200);
    }

    public function posts(Category $category)
    {
        $category->load('posts');
        
        return response([
            'posts' => $category->posts
        ], 200);
    }
}
