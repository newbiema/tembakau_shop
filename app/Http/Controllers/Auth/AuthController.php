<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('logout');        
    }

    public function index() 
    {
        return view("auth.login");    
    }

    public function login(Request $request) 
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $roles = $user->getRoleNames(); 

                Auth::login($user);

                if ($roles[0] === "Admin") {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('user.product');
                }
            } else {
                return back()->with('err', 'Email/Password Salah');
            }
        } 

        return back()->with('err', 'Akun tidak terdaftar');
    }

    public function logout() 
    {
        Auth::logout();
        Session::flush();
        
        return redirect()->route('login');
    }
}
