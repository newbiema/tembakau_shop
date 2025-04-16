<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() 
    {
        return view("profile.index");    
    }

    public function updateProfile(Request $request, $id) 
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'image' => 'mimes:png,jpg,jpeg'
        ]);

        $post = $request->except('image');

        $user = User::find($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = rand() . '.' . $image->getClientOriginalExtension();
            $path = 'user_profile/';
            $image->move($path, $imageName);

            $post['image'] = $path . $imageName;
            $user->update($post);
        }

        $user->update($post);

        return back()->with('success', 'Berhasil mengubah profile.');
    }

    public function resetPassword(Request $request, $id) 
    {
        $request->validate([
            'password' => 'required|min:8',
            'password_confirmation' => 'required'
        ]);  

        $post = $request->except('password_confirmation');

        $user = User::find($id);

        $user->update($post);

        return back()->with('success', 'Berhasil mengubah password.');
    }
}
