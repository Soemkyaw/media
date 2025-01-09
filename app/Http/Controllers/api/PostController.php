<?php

namespace App\Http\Controllers\api;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->with('category')->filter(request('search'))->get();

        return response()->json([
            'posts' => $posts
        ], 200);
    }

    public function randomPosts()
    {
        $randomPosts = Post::inRandomOrder()->take(3)->get();

        return response()->json([
            'randomPosts' => $randomPosts
        ],200);
    }

    public function show(Post $post)
    {
        $post = Post::where('id', $post->id)->with('category')->first();

        return response()->json([
            'post' => $post
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', Rule::unique('posts', 'title')],
            'content' => ['required', 'string', 'min:5'],
            'featured_image' => ['required', 'mimes:png,jpg,jpeg'],
            'category_id' => ['required','integer']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ],422);
        }

        $path = $request->file('featured_image')->store('post-images', 'public');

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => $request->user()->id,
            'featured_image' => $path,
        ]);

        return response()->json([
            'message' => "New post created...",
            'post' => $post
        ],200);
    }

    public function update(Post $post)
    {
        $validator = Validator::make(request()->all(), [
            'title' => ['required', Rule::unique('posts', 'title')->ignore($post->id)],
            'content' => ['required', 'string', 'min:5'],
            'featured_image' => ['mimes:png,jpg,jpeg'],
            'category_id' => ['required', 'integer']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }

        $attributes = [
            'title' => request('title'),
            'content' => request('content'),
            'category_id' => request('category_id'),
        ];

        if (request()->hasFile('featured_image')) {
            Storage::delete('public/'.$post->featured_image);

            $path = request()->file('featured_image')->store('post-images', 'public');
            $attributes['featured_image'] = $path;
        }

        $post->update($attributes);

        return response()->json([
            'message' => "Post updated successful...",
            'post' => $post
        ], 200);
    }

    public function destroy(Post $post)
    {
        Storage::delete('public/' . $post->featured_image);
        $post->delete();
        return response()->json([
            'message' => "Post has been deleted"
        ], 200);
    }
}
