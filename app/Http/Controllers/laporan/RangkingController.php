<?php

namespace App\Http\Controllers\laporan;

use App\Http\Controllers\Controller;
use App\Models\presensi\presensi;
use App\Models\presensi\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RangkingController extends Controller
{
    public function index()
    {
        return view('reports.ranking.index');
    }

    public function getRanking(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
        ]);

        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');
        $mulai = \Carbon\Carbon::createFromFormat('m/d/Y', $tanggalMulai)->format('Y-m-d');
        $selesai = \Carbon\Carbon::createFromFormat('m/d/Y', $tanggalSelesai)->format('Y-m-d');
        $rankingSakit = Presensi::select('nis_siswa', DB::raw('count(*) as jumlah_sakit'))
            ->whereBetween('tanggal', [$mulai, $selesai])
            ->where('status', 'Sakit')
            ->groupBy('nis_siswa')
            ->orderByDesc('jumlah_sakit')
            ->take(5)
            ->with('siswa') // Tambahkan eager loading relasi siswa
            ->get()
            ->map(function ($item) {
                return [
                    'nis' => $item->siswa->NIS,
                    'nama' => $item->siswa->nama_siswa,
                    'kelas' => $item->siswa->kelas->nama_kelas,
                    'jumlah_sakit' => $item->jumlah_sakit,
                ];
            });

        $rankingIzin = Presensi::select('nis_siswa', DB::raw('count(*) as jumlah_izin'))
            ->whereBetween('tanggal', [$mulai, $selesai])
            ->where('status', 'Izin')
            ->groupBy('nis_siswa')
            ->orderByDesc('jumlah_izin')
            ->take(5)
            ->with('siswa')
            ->get()
            ->map(function ($item) {
                return [
                    'nis' => $item->siswa->NIS,
                    'nama' => $item->siswa->nama_siswa,
                    'kelas' => $item->siswa->kelas->nama_kelas,
                    'jumlah_izin' => $item->jumlah_izin,
                ];
            });

        $rankingAlpha = Presensi::select('nis_siswa', DB::raw('count(*) as jumlah_alpha'))
            ->whereBetween('tanggal', [$mulai, $selesai])
            ->where('status', 'Alpha')
            ->groupBy('nis_siswa')
            ->orderByDesc('jumlah_alpha')
            ->take(5)
            ->with('siswa')
            ->get()
            ->map(function ($item) {
                return [
                    'nis' => $item->siswa->NIS,
                    'nama' => $item->siswa->nama_siswa,
                    'kelas' => $item->siswa->kelas->nama_kelas,
                    'jumlah_alpha' => $item->jumlah_alpha,
                ];
            });
        return view('reports.ranking.index', compact('rankingSakit', 'rankingIzin', 'rankingAlpha'));
    }
}