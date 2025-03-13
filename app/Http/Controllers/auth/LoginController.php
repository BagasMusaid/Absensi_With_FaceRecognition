<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\master_data\GuruPiket;
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
        foreach (['web', 'wali', 'guru_piket', 'gurus'] as $guard) {
            Auth::guard($guard)->logout();
        }

        Auth::logout(); // Logout dari default guard (web)
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        //END SESI 

        if (Auth::guard('web')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('dashbord');
        }

        $guru = Guru::where('email', $request->email)->first();
        if ($guru) {
            if ($guru->kepalasekolah === 'ya' && Hash::check($request->password, $guru->password)) {
                // Login kepala sekolah menggunakan guard 'guru'
                if (Auth::guard('gurus')->attempt(['email' => $guru->email, 'password' => $request->password], $remember)) {
                    $request->session()->regenerate();
                    return redirect()->route('dashbord');
                }
            }

            // Setelah menemukan guru, ambil data walikelas berdasarkan guru_id
            $walikelas = Walikelas::where('guru_id', $guru->kd_guru)->first();

            if ($walikelas && Hash::check($request->password, $walikelas->password)) {
                // Jika password cocok, autentikasi walikelas dan redirect ke dashboard
                if (Auth::guard('wali')->attempt(['guru_id' => $guru->kd_guru, 'password' => $request->password], $remember)) {
                    $request->session()->regenerate();
                    return redirect()->route('dashbord');
                }
            }
            $guruPiket = GuruPiket::where('guru_id', $guru->kd_guru)->first();
            if ($guruPiket && Hash::check($request->password, $guruPiket->password)) {
                if (Auth::guard('guru_piket')->attempt(['guru_id' => $guru->kd_guru, 'password' => $request->password], $remember)) {
                    $request->session()->regenerate();
                    return redirect()->route('dashbord');
                }
            }
        }

        return back()->with('loginerror', 'Email atau password salah!');
    }
    public function logout(Request $request)
    {

        foreach (['web', 'wali', 'guru_piket', 'gurus'] as $guard) {
            Auth::guard($guard)->logout();
        }
        session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // $request->session()->regenerate();
        dd([
            'web' => Auth::guard('web')->check(),
            'wali' => Auth::guard('wali')->check(),
            'gurus' => Auth::guard('gurus')->check(),
            'guru_piket' => Auth::guard('guru_piket')->check(),
        ]);
        return redirect()->route('login');
    }
}
