@extends('App.layout')

@section('content')
    <div class="">
        <div class=" text-center font-bold text-gray-400 text-3xl my-3">
            Edit {{ $user->name }}
        </div>

        <form action="{{ route('user.update',$user->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col max-w-md mx-auto my-5">
            @csrf
            @method('PATCH')
            <div class=" space-y-2 mb-3">
                <label for="username" class=" text-gray-400 font-bold">Username</label>
                <input type="text" id="username" name="name"
                    class="block w-full bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
                    placeholder="Full Name" value="{{ $user->name }}">
                    @error('name')
                    <small class=" text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class=" space-y-2 mb-3">
                <label for="email" class=" text-gray-400 font-bold">Email</label>
                <input type="email" id="email" disabled name="email"
                    class="block w-full bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
                    placeholder="Email" value="{{ $user->email }}">
            </div>
            <div class=" space-y-2 mb-3">
                <label for="gender" class=" text-gray-400 font-bold">Gender</label>
                <select name="gender" id="gender"
                    class="w-full bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150">
                    <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div class=" space-y-2 mb-3">
                <label for="address" class=" text-gray-400 font-bold">Address</label>
                <textarea  id="address" name="address"
                    class="w-full bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
                    placeholder="Address">{{ $user->address }}</textarea>
                @error('address')
                    <small class=" text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class=" space-y-2 mb-3">
                <label for="profile" class=" text-gray-400 font-bold">Profile Picture</label>
                <input type="file" id="profile" name="profile_picture"
                    class="block w-full bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
                    placeholder="Resume">
                @error('profile_picture')
                    <small class=" text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit"
                class="bg-gradient-to-r from-indigo-500 to-blue-500 bg-indigo-500 text-white font-bold py-2 px-4 rounded-md mt-4 hover:bg-indigo-600 hover:to-blue-600 transition ease-in-out duration-150">Update</button>
            <a href="{{ route('users') }}" class=" text-blue-500 underline text-center mt-3">
                back to users
            </a>
        </form>
    </div>
@endsection
