<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            $user = User::first();
            auth()->loginUsingId($user->id, true);
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            switch (auth()->user()->role) {
                case 0:
                    return redirect()->route('home');
                break;
                case 1:
                    return redirect()->route('dashboard');
                break;
            }
        } else {
            return redirect()->back()->with('message', 'Email dan Password tidak sesuai!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
