<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuthLog;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout()
    {
        $user = auth()->user();

        if ($user) {
            $lastLogin = AuthLog::success()
                ->where('user_id', $user->id)
                ->whereNull('logged_out_at')
                ->latest('id')
                ->first();

            if ($lastLogin) {
                $lastLogin->update([
                    'logged_out_at'    => now(),
                    'duration_seconds' => now()->diffInSeconds($lastLogin->created_at),
                ]);
            }
        }

        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }
}