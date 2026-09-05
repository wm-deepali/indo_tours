<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            $user = auth()->user();

            if ($user) {
                return redirect()->to('admin/dashboard');
            }

            return redirect()->to('/login');
        }
        return back()->with('error', 'Email-Address And Password Are Wrong.');
    }
}