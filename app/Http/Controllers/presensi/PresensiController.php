<?php

namespace App\Http\Controllers\presensi;

use App\Http\Controllers\Controller;
use App\Models\presensi\presensi;
use App\Models\presensi\Siswa;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index()
    {
        return view('pages.presensi.presensi');
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

        $sudahAda = Presensi::where('nis_siswa', $request->nis_siswa)
            ->whereDate('tanggal', $request->tanggal)
            ->exists();

        if ($sudahAda) {
            return response()->json(['message' => 'Presensi sudah dicatat.'], 200);
        }

        Presensi::create([
            'nis_siswa' => $request->nis_siswa,
            'tanggal' => $request->tanggal,
            'waktu_presensi' => $request->waktu_presensi,
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'Presensi berhasil dicatat.']);
    }
}
