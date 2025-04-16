<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerifyEmailController extends Controller
{
    public function verify($token) 
    {   
        $verify = DB::table('user_verifies')->where('token', $token)->first();

        $message = "Email anda belum terverifikasi.";

        if (!is_null($verify)) {
            $user = User::where('email', $verify->email)->first();

            if (!$user->email_verified_at) {
                $user->update(['email_verified_at' => Carbon::now()]);

                DB::table('user_verifies')->where('email', $user->email)->delete();

                $message = "Berhasil verifikasi email. Silahkan login kembali";
            } else {
                $message = "Akun anda sudah melakukan verifikasi email. Silahkan login kembali";
            }
        }

        return redirect()->route('login')->with('success', $message);
    }
}
