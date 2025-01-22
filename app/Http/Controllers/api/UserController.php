<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // user login api
    public function login(Request $request)
    {
        $valitor = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:3']
        ]);

        if ($valitor->fails()) {
            return response()->json([
                'message' => 'Unprocessable. Something wrong !'
            ],422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => "Unprocessable!"
            ], 401);
        }

        $isPasswordCheck = Hash::check($request->password, $user->password);

        if (!$isPasswordCheck) {
            return response()->json([
                'message' => "password wrong"
            ], 401);
        }
        $token = $user->createToken('user-token')->plainTextToken;

        return response()->json([
            'message' => 'login success',
            'token' => $token,
            'user' => $user
        ],200);
    }

    // user register api
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required','min:3'],
            'email' => ['required', 'email', 'min:2'],
            'password' => ['confirmed']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Unprocessable. Something wrong !'
            ], 422);
        }

        $isExists = User::where('email', $request->email)->exists();

        if ($isExists) {
            return response()->json([
                'message' => 'email already exists.'
            ], 422);
        }

        $password = Hash::make($request->password);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password
        ]);

        $token = $user->createToken('user-token')->plainTextToken;

        return response()->json([
            'message' => 'New account created .',
            'token' => $token,
            'user' => $user
        ],200);
    }

    // user update api
    public function update(User $user)
    {
        $validator = Validator::make(request()->all(), [
            'name' => ['required'],
            'gender' => ['required', 'in:male,female,other'],
            'address' => ['required', 'min:3'],
            'profile_picture' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Unprocessable. Something wrong !'
            ], 422);
        }

        if ($user->id != request()->user()->id) {
            return response()->json([
                'message' => 'U can\'t update another profile.'
            ],403);
        }

        $path = request()->file('profile_picture')->store('profile-images', 'public');
        // $path = Storage::url($path);
        $user->update([
            'name' => request('name'),
            'gender' => request('gender'),
            'address' => request('gender'),
            'profile_picture' => $path
        ]);

        return response()->json([
            'message' => 'Profile update successful...'
        ], 200);

    }


}
