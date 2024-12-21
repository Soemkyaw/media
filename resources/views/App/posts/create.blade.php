@extends('App.layout')

@section('content')
    <div class="">
        <div class=" text-center font-bold text-gray-400 text-3xl my-3">
            Post Create Form
        </div>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col max-w-full mx-auto my-5 border p-5 rounded shadow-lg">
            @csrf
            <div class=" space-y-2 mb-3">
                <label for="featured_image" class=" text-gray-400 font-bold">Feature Image</label>
                <input type="file" id="featured_image" name="featured_image"
                    class="block w-full bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150">
                @error('featured_image')
                    <small class=" text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class=" space-y-2 mb-3">
                <label for="title" class=" text-gray-400 font-bold">Title</label>
                <input type="text" id="title" name="title"
                    class="block w-full bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
                    placeholder="Enter category title" value="{{ old('title') }}">
                    @error('title')
                    <small class=" text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class=" space-y-2 mb-3">
                <label for="category_id" class=" text-gray-400 font-bold">Category</label>
                <select name="category_id" id="category_id"
                    class="block w-full bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150">
                    <option disabled selected>Choose category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <small class=" text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class=" space-y-2 mb-3">
                <label for="content" class=" text-gray-400 font-bold">Content</label>
                <textarea  id="content" name="content"
                    class="w-full bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
                    placeholder="Enter post content">{{ old('content') }}</textarea>
                @error('content')
                    <small class=" text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit"
                class="bg-gradient-to-r from-indigo-500 to-blue-500 bg-indigo-500 text-white font-bold py-2 px-4 rounded-md mt-4 hover:bg-indigo-600 hover:to-blue-600 transition ease-in-out duration-150">Save</button>
            <a href="{{ route('posts') }}" class=" text-blue-500 underline text-center mt-3">
                back to posts
            </a>
        </form>
    </div>
@endsection
