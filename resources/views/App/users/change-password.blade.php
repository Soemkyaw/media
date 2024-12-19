@extends('App.layout')

@section('content')
    <div class="">
        <div class=" text-center font-bold text-gray-400 text-2xl my-3">
            Edit {{ $user->name }} password
        </div>

        <form action="{{ route('user.password.update',$user->id) }}" method="POST" class="flex flex-col max-w-md mx-auto my-5">
            @csrf
            @method('PATCH')
            <div class=" space-y-2 mb-3">
                <label for="old_password" class=" text-gray-400 font-bold">Old Password</label>
                <input type="password" id="old_password" name="old_password"
                    class="block w-full bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150">
                    @error('old_password')
                    <small class=" text-red-500">{{ $message }}</small>
                    @enderror
            </div>
            <div class=" space-y-2 mb-3">
                <label for="new_password" class=" text-gray-400 font-bold">New Password</label>
                <input type="password" id="new_password" name="new_password"
                    class="block w-full bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150">
                @error('new_password')
                    <small class=" text-red-500">{{ $message }}</small>
                    @enderror
            </div>
            <div class=" space-y-2 mb-3">
                <label for="new_password_confirmation" class=" text-gray-400 font-bold">Comfirm Password</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                    class="block w-full bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150">
                    @error('new_password_confirmation')
                    <small class=" text-red-500">{{ $message }}</small>
                    @enderror
            </div>
            <button type="submit"
                class="bg-gradient-to-r from-indigo-500 to-blue-500 bg-indigo-500 text-white font-bold py-2 px-4 rounded-md mt-4 hover:bg-indigo-600 hover:to-blue-600 transition ease-in-out duration-150">Update</button>
            <a href="{{ route('user.show',$user->id) }}" class=" text-blue-500 underline text-center mt-3">
                back to profile
            </a>
        </form>
    </div>
@endsection
