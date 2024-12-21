<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        return view('App.posts.index',[
            'posts' => Post::with('category')->get()
        ]);
    }

    public function create()
    {
        return view('App.posts.create',[
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required',Rule::unique('posts','title')],
            'content' => ['required', 'min:5'],
            'category_id' => ['required'],
            'featured_image' => ['required','mimes:png,jpg,jpeg']
        ],[
            'category_id' => 'Need to chooose category.'
        ]);
        $attributes['user_id'] = auth()->id();
        $attributes['featured_image'] = $request->file('featured_image')->store('post-images', 'public');

        Post::create($attributes);

        return redirect()->route('posts');
    }

    public function show(Post $post)
    {
        return view('App.posts.show',[
            'post' => $post
        ]);
    }

    public function edit(Post $post)
    {
        return view('App.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    public function update(Post $post)
    {
        $attributes = request()->validate([
            'title' => ['required', Rule::unique('posts', 'title')->ignore($post->id)],
            'content' => ['required', 'min:5'],
            'category_id' => ['required'],
            'featured_image' => ['mimes:png,jpg,jpeg']
        ]);

        if (request()->hasFile('featured_image')) {
            Storage::delete('public/' . $post->featured_image);
            $attributes['featured_image'] = request()->file('featured_image')->store('post-images', 'public');
        }
        $post->update($attributes);

        return redirect()->route('posts');
    }

    public function destroy(Post $post)
    {
        Storage::delete('public/' . $post->featured_image);
        $post->delete();

        return redirect()->route('posts');
    }
}
