<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\master_data\Walikelas;
use App\Models\presensi\Guru;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function authenticate(Request $request)
    {
        $remember = $request->remember;
        $credentials = $request->validate([
            'email' => 'required|email|max:225',
            'password' => 'required|alpha_dash|max:225'
        ]);
        //HAPUS SESI SEBELUM MELKUKAN LOGIN
        Auth::guard('web')->logout();
        Auth::guard('wali')->logout();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        //END SESI 

        if (Auth::guard('web')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('dashbord');
        }
        $guru = Guru::where('email', $request->email)->first();
        if ($guru) {
            // Setelah menemukan guru, ambil data walikelas berdasarkan guru_id
            $walikelas = Walikelas::where('guru_id', $guru->kd_guru)->first();

            if ($walikelas && Hash::check($request->password, $walikelas->password)) {
                // Jika password cocok, autentikasi walikelas dan redirect ke dashboard
                if (Auth::guard('wali')->attempt(['guru_id' => $guru->kd_guru, 'password' => $request->password], $remember)) {
                    $request->session()->regenerate();
                    return redirect()->route('dashbord');
                }
            }
        }
        return back()->with('loginerror', 'Email atau password salah!');
    }
    public function logout(Request $request)
    {
        if (Auth::guard('wali')->check()) {
            Auth::guard('wali')->logout();
        } elseif (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->regenerate();

        return redirect('login');
    }
}
