<?php

namespace App\Http\Controllers;

use App\Models\master_data\kelas;
use App\Models\presensi\Guru;
use App\Models\presensi\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DashbordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web,wali');
    }

    public function index(Request $request)
    {
        $hour = now()->hour; // Ambil jam saat ini

        if ($hour >= 5 && $hour < 12) {
            $greeting = "Selamat pagi";
        } elseif ($hour >= 12 && $hour < 15) {
            $greeting = "Selamat siang";
        } elseif ($hour >= 15 && $hour < 18) {
            $greeting = "Selamat sore";
        } else {
            $greeting = "Selamat malam";
        }


        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $kelas = kelas::count();
        $gurus = Guru::count();
        $siswas = Siswa::count();

        return view('dashbord', compact('kelas', 'gurus', 'siswas', 'greeting'));
    }
}
