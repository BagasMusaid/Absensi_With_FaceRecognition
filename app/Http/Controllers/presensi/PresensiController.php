<?php

namespace App\Http\Controllers\presensi;

use App\Http\Controllers\Controller;
use App\Models\presensi\JadwalPresensi;
use App\Models\presensi\presensi;
use App\Models\presensi\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index($kelasId)
    {
        $jadwal = JadwalPresensi::with('kelas')
            ->where('kelas_id', $kelasId)
            ->whereDate('tanggal', now()->toDateString())
            ->latest()
            ->first();

        if (!$jadwal) {
            return redirect()->back()->with('error', 'Tidak ada jadwal presensi untuk kelas ini hari ini.');
        }

        $now = now();
        $jamMulai = Carbon::parse("{$jadwal->tanggal} {$jadwal->jam_mulai}");
        $jamSelesai = Carbon::parse("{$jadwal->tanggal} {$jadwal->jam_selesai}");

        // Cek apakah sekarang belum masuk jam presensi atau sudah lewat
        if ($now->lessThan($jamMulai)) {
            alert()->info('Info', 'PRESENSI BELUM DIMULAI');
            return redirect()->back()->with('error', 'Presensi belum dimulai.');
        }

        if ($now->greaterThan($jamSelesai)) {
            alert()->info('Info', 'PRESENSI TELAH BERAKHIR');
            return redirect()->back()->with('error', 'Presensi untuk kelas ini sudah berakhir hari ini.');
        }

        $kelasAktif = $jadwal->kelas; // misalnya kelas_id = 3

        // Ambil daftar NIS siswa dari kelas ini
        $nisDariKelas = Siswa::where('kelas_id', $kelasAktif->id)->pluck('nis')->toArray();


        // Ambil presensi siswa hari ini untuk jadwal ini
        $presensiHariIni = Presensi::with('siswa') // pastikan ada relasi 'siswa' di model Presensi
            ->where('jadwal_id', $jadwal->id)
            ->whereDate('tanggal', now()->toDateString())
            ->get();

        // Lanjut tampilkan halaman presensi
        return view('pages.presensi.presensi', compact('nisDariKelas', 'kelasAktif', 'presensiHariIni', 'jadwal'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis_siswa' => 'required|exists:siswas,NIS',
            'tanggal' => 'required|date',
            'waktu_presensi' => 'required|date_format:H:i:s',
            'status' => 'required|in:Hadir,Alpha,Sakit,Izin',
        ]);

        $siswa = Siswa::where('NIS', $validated['nis_siswa'])->first();

        if (!$siswa) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }
        $jadwal = JadwalPresensi::where('kelas_id', $siswa->kelas_id)
            ->whereDate('tanggal', $validated['tanggal'])
            ->latest()
            ->first();

        if (!$jadwal) {
            return response()->json(['message' => 'Jadwal presensi tidak ditemukan untuk hari ini'], 404);
        }

        $sudahAda = Presensi::where('nis_siswa', $request->nis_siswa)
            ->whereDate('tanggal', $request->tanggal)
            ->exists();

        if ($sudahAda) {
            return response()->json(['message' => 'Presensi sudah dicatat.'], 200);
        }

        Presensi::create([
            'jadwal_id' => $jadwal->id,
            'nis_siswa' => $request->nis_siswa,
            'tanggal' => $request->tanggal,
            'waktu_presensi' => $request->waktu_presensi,
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'Presensi berhasil dicatat.']);
    }
    public function getPresensiByJadwal($jadwalId)
    {
        $presensi = Presensi::with('siswa')
            ->where('jadwal_id', $jadwalId)
            ->whereDate('tanggal', now()->toDateString())
            ->latest()
            ->get();

        return response()->json($presensi);
    }
}
