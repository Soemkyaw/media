@extends('App.layout')

@section('content')
    <div class="w-full max-w-xl mx-auto bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-end px-4 pt-4">
            <button id="dropdownButton" data-dropdown-toggle="dropdown"
                class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                type="button">
                <span class="sr-only">Open dropdown</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 16 3">
                    <path
                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdown"
                class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2" aria-labelledby="dropdownButton">
                    <li>
                        <a href="{{ route('user.edit',$user->id) }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                    </li>
                    <li>
                        <a href="{{ route('user.change.password',$user->id) }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Change Password</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col items-center pb-10">
            @if ($user->profile_picture)
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ asset('storage/' . $user->profile_picture) }}"/>
            @else
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ asset('images/user-default.png') }}"/>
            @endif
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $user->name }}</h5>
            <span class="text-sm text-gray-500 dark:text-gray-400 border-b border-green-300 mb-2">{{ $user->email }}</span>
            <div class=" border-b border-green-300 mb-2">
                <span class="text-sm text-gray-500 dark:text-gray-400">Address :</span>
                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $user->address }}</span>
            </div>
            <div class=" border-b border-green-300 mb-2">
                <span class="text-sm text-gray-500 dark:text-gray-400">Gender :</span>
                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $user->gender }}</span>
            </div>

            <div class="flex mt-4 md:mt-6">
                <a href="{{ route('users') }}" class=" text-blue-500 underline text-sm">back to users</a>
            </div>
        </div>
    </div>
@endsection
