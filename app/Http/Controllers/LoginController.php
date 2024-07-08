<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController
{

    public function login()
    {
        return view('pages.login.index');
    }

    public function loginPost(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        if($user && Auth::attempt(['email' => $user->email, 'password' => $request->password])){
            return redirect()->route('admin.index');
        }

        return redirect()->route('login')->withErrors(['msg' => 'A felhasználónév vagy jelszó nem megfelelő!']);
    }
}
