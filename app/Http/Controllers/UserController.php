<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        return view('App.users.index',[
            'users' => User::all()
        ]);
    }

    public function show(User $user)
    {
        return view('App.users.show', [
            'user' => $user
        ]);
    }

    public function edit(User $user)
    {
        return view('App.users.edit',[
            'user' => $user
        ]);
    }

    public function update(User $user)
    {
        $attributes = request()->validate([
            'name' => ['required', 'min:3', Rule::unique('users','name')->ignore($user->id)],
            'gender' => ['required', 'in:male,female,other'],
            'address' => ['required', 'min:3'],
        ]);

        if (request()->hasFile('profile_picture')) {
            request()->validate([
                'profile_picture' => ['mimes:png,jpg,jpeg']
            ]);

            if ($user->profile_picture && Storage::exists('public/'.$user->profile_picture)) {
                Storage::delete('public/' . $user->profile_picture);
            }

            $attributes['profile_picture'] = request()->file('profile_picture')->store('profile-images', 'public');
        }

        $user->update($attributes);

        return redirect()->route('users');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users');
    }

    public function changePassword(User $user)
    {
        return view('App.users.change-password',[
            'user' => $user
        ]);
    }

    public function passwordHandler(User $user)
    {
        request()->validate([
            'old_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $oldPasswordStatus = Hash::check(request('old_password'), auth()->user()->password);
        if ($oldPasswordStatus) {
            $user->update([
                'password' => Hash::make(request('new_password'))
            ]);
            return redirect()->route('user.show',$user->id);
        }else{
            return redirect()->back();
        }
    }
}
