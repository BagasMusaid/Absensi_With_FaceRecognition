<?php

namespace App\Http\Controllers;

use App\Models\master_data\kelas;
use App\Models\presensi\Guru;
use App\Models\presensi\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\presensi\StoreJadwalPresensi;
use App\Models\master_data\Mapel;
use App\Models\master_data\TahunAjaran;
use App\Models\presensi\JadwalPresensi;
use App\Models\presensi\presensi;
use Carbon\Carbon;

class DashbordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web,wali,guru_piket,gurus');
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
        $kelasDenganJadwalHariIni = Kelas::whereDoesntHave('jadwal_presensi', function ($query) {
            $query->whereDate('tanggal', Carbon::today());
        })->get();
        $kelas = kelas::count();
        $gurus = Guru::count();
        $siswas = Siswa::count();
        $PresensiHariIni = presensi::whereDate('tanggal', Carbon::today())->count();
        $Mapels = Mapel::count();
        $tahunAjaran = TahunAjaran::where('status', 'aktif')->first();
        $tanggal = Carbon::now()->translatedFormat('l, d F Y');

        return view('dashbord', compact('kelas', 'gurus', 'siswas', 'greeting', 'PresensiHariIni', 'Mapels', 'kelasDenganJadwalHariIni', 'tahunAjaran', 'tanggal'));
    }
    public function store_jadwal(StoreJadwalPresensi $request)
    {
        try {
            $existingJadwal = JadwalPresensi::where('kelas_id', $request->kelas_id)
                ->whereDate('tanggal', Carbon::today()->toDateString()) // gunakan ini
                ->first();

            if ($existingJadwal) {
                alert()->info('Info', 'Kelas Sudah Mempunyai Jadwal Presensi Hari Ini');
                return redirect()->back();
            }
            JadwalPresensi::create([
                'kelas_id'   => $request->kelas_id,
                'tanggal'    => Carbon::today()->toDateString(),
                'jam_mulai'  => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
            ]);
            alert()->success('Success', 'Berhasil Mengatur Jadwal');
            return redirect()->route('presensi.presensi-wajah', ['kelasId' => $request->kelas_id]);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput();
        }
    }
}
