@extends('App.layout')

@section('content')
    <section class=" mb-5">
        <div class=" text-center text-2xl font-bold text-gray-400 my-3">
            <h5>{{ $post->title }} Detail</h5>
        </div>
        <div
            class="w-full relative max-w-xl mx-auto bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg w-full object-cover max-h-72"
                    src="{{ asset('storage/' . $post->featured_image) }}" />
            </a>
            <span class=" py-2 px-3 bg-gray-100 rounded-full absolute top-0 mt-2 ml-2">
                {{ $post->category->name }}
            </span>
            <div class="p-5">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $post->title }}</h5>
                <h5 class="mb-2 text-gray-800">Publish Date - {{ $post->created_at->format('F d, Y') }}</h5>
                <p class="mb-3 font-normal text-gray-600 dark:text-gray-400">{{ $post->content }}</p>
                <a href="{{ route('posts') }}" class=" text-blue-500 underline">
                    back to posts
                </a>
            </div>
        </div>
    </section>
@endsection
