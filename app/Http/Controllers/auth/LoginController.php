<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns|max:225',
            'password' => 'required|alpha_dash|max:225'
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            alert()->success('Login Berhasil');
            return redirect()->route('dashbord');
        }
        if (Auth::guard('guru')->attempt($credentials)) {
            $request->session()->regenerate();
            alert()->success('Login Berhasil');
            return redirect()->route('dashbord');
        }

        return back()->with('loginerror', 'Email atau password salah!');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
