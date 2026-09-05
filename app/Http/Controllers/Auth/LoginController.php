<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AuthLog;
use App\Services\GeoIpService;
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

        $agent = new Agent();
        $agent->setUserAgent($request->userAgent());

        $deviceType = $agent->isMobile() ? 'Mobile' : ($agent->isTablet() ? 'Tablet' : 'Desktop');
        $browser    = $agent->browser() . ' ' . $agent->version($agent->browser());
        $platform   = $agent->platform() . ' ' . $agent->version($agent->platform());

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            $user = auth()->user();

            if ($user) {
                $geo = GeoIpService::lookup($request->ip());

                // Suspicious check: compare against user's usual country from past successful logins
                $usualCountry = AuthLog::success()
                    ->where('user_id', $user->id)
                    ->whereNotNull('country')
                    ->orderByDesc('id')
                    ->value('country');

                $isSuspicious = $usualCountry && $geo['country'] && $geo['country'] !== $usualCountry;

                AuthLog::create([
                    'user_id'      => $user->id,
                    'user_type'    => 'admin',
                    'email'        => $request->email,
                    'event'        => 'login',
                    'status'       => 'success',
                    'ip_address'   => $request->ip(),
                    'user_agent'   => $request->userAgent(),
                    'device_type'  => $deviceType,
                    'browser'      => trim($browser),
                    'platform'     => trim($platform),
                    'city'         => $geo['city'],
                    'country'      => $geo['country'],
                    'isp'          => $geo['isp'],
                    'is_suspicious'=> $isSuspicious,
                ]);

                $user->update([
                    'last_login_at'     => now(),
                    'last_login_ip'     => $request->ip(),
                    'last_login_device' => trim($browser) . ' / ' . trim($platform),
                    'login_count'       => $user->login_count + 1,
                ]);

                return redirect()->to('admin/dashboard');
            }

            return redirect()->to('/login');
        }

        AuthLog::create([
            'user_type'     => 'admin',
            'email'         => $request->email,
            'event'         => 'login_failed',
            'status'        => 'failed',
            'ip_address'    => $request->ip(),
            'user_agent'    => $request->userAgent(),
            'error_message' => 'Invalid email or password',
            'device_type'   => $deviceType,
            'browser'       => trim($browser),
            'platform'      => trim($platform),
        ]);

        return back()->with('error', 'Email-Address And Password Are Wrong.');
    }
}