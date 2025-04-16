<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index() 
    {
        return view("auth.register");  
    }

    public function register(Request $request) 
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $post = $request->except('password_confirmation');

        $user = User::create($post);

        $user->assignRole('User');

        $token = Str::random(60);

        DB::table('user_verifies')->insert(['email' => $request->email, 'token' => $token]);

        Mail::send('email.verification', ['token' => $token], function($message) use ($request) {
            $message->to($request->email);
            $message->subject('Email Verifikasi Akun');
        });

        return redirect()->route('login')->with('success', 'Berhasil mendaftarkan akun. Silahkan cek email anda untuk melakukan verifikasi akun');
    }
}
