<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;

class logincontroller extends Controller
{
    function login()
    {
        return view('login');
    }

    function checklogin(request $request)
    {
        $formfields = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = user::where('email', $formfields['email'])->first();

        if ($user) {
            if ($user->password == $formfields['password']) {
                $request->session()->regenerate();
                return redirect('/admin')->with('success', 'You are logged in');
            } else {
                return back()->withErrors(['password' => 'invalid password'])->onlyInput('password');
            }
        } else {
            return back()->withErrors(['email' => 'invalid email'])->onlyInput('email');
        }
    }
}
