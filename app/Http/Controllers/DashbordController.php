<?php

namespace App\Http\Controllers;

use App\Models\master_data\kelas;
use App\Models\presensi\Guru;
use App\Models\presensi\Siswa;
use Illuminate\Http\Request;

class DashbordController extends Controller
{
    public function index(Request $request)
    {
        $kelas = kelas::count();
        $gurus = Guru::count();
        $siswas = Siswa::count();
        return view('dashbord', compact('kelas', 'gurus', 'siswas'));
    }
}
