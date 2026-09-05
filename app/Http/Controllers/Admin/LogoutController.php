<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuthLog;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }
}