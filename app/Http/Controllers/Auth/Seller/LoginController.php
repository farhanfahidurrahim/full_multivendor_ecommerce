<?php

namespace App\Http\Controllers\Auth\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function ShowLoginForm()
    {
        return view('seller.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:sellers,email',
            'password'=>'required|min:6'
        ]);

        if (Auth::guard('seller')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended(route('seller'))->with('success',"You are logged in as Seller!");
        }
        return back()->withInput($request->only('seller'))->with('error',"Invalid Password!");
    }
}
