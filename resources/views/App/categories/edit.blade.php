@extends('App.layout')

@section('content')
    <div class="">
        <div class=" text-center font-bold text-gray-400 text-3xl my-3">
            Category Edit Form
        </div>

        <form action="{{ route('categories.update',$category->slug) }}" method="POST" class="flex flex-col max-w-lg mx-auto my-5 border p-5 rounded shadow-lg">
            @csrf
            @method('PATCH')
            <div class=" space-y-2 mb-3">
                <label for="name" class=" text-gray-400 font-bold">Name</label>
                <input type="text" id="name" name="name"
                    class="block w-full bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
                    placeholder="Enter category name" value="{{ $category->name }}">
                    @error('name')
                    <small class=" text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class=" space-y-2 mb-3">
                <label for="description" class=" text-gray-400 font-bold">Description</label>
                <textarea  id="description" name="description"
                    class="w-full bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
                    placeholder="Enter category description">{{ $category->description }}</textarea>
                @error('description')
                    <small class=" text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit"
                class="bg-gradient-to-r from-indigo-500 to-blue-500 bg-indigo-500 text-white font-bold py-2 px-4 rounded-md mt-4 hover:bg-indigo-600 hover:to-blue-600 transition ease-in-out duration-150">Update</button>
            <a href="{{ route('categories') }}" class=" text-blue-500 underline text-center mt-3">
                back to categories
            </a>
        </form>
    </div>
@endsection
