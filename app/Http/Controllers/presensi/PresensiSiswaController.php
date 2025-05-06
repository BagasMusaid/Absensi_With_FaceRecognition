<?php

namespace App\Http\Controllers\presensi;

use App\Http\Controllers\Controller;
use App\Http\Requests\presensi\StorePresensiRequest;
use App\Http\Requests\presensi\UpdatePresensiRequest;
use App\Models\master_data\Kelas;
use App\Models\presensi\JadwalPresensi;
use App\Models\presensi\presensi;
use App\Models\presensi\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresensiSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $presensiQuery = presensi::with('siswa');
        if (!empty($search)) {
            $presensiQuery->where(function ($query) use ($search) {
                $query->where('tanggal', 'like', "%$search%")
                    ->orWhere('status', 'like', "%$search%")
                    ->orWhereHas('siswa', function ($query) use ($search) {
                        $query->where('nama_siswa', 'like', "%$search%")
                            ->orWhere('NIS', 'like', "%$search%");
                    });
            });
        }
        $presensi = $presensiQuery->latest()->paginate(5);
        $kelas = Kelas::all();
        if ($request->ajax()) {
            return view('pages.presensi-siswa.index', compact('presensi', 'kelas'))->render();
        }
        return view('pages.presensi-siswa.index', compact('presensi', 'kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePresensiRequest $request)
    {

        try {
            $waktu = Carbon::now()->format('H:i:s');
            $tanggal = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');
            Presensi::create([
                'nis_siswa' => $request->nis_siswa,
                'tanggal' => $tanggal,
                'waktu_presensi' =>  $waktu, // waktu sekarang
                'status' => $request->status,
            ]);

            alert()->success('Success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi Kesalahan Saat Menambahkan Data');
            return redirect()->back()->withInput();
        }
        return redirect()->route('presensi-siswa.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePresensiRequest $request, string $id)
    {
        try {
            $waktu = Carbon::createFromFormat('H:i', $request->waktu)->format('H:i:s');
            $tanggal = Carbon::createFromFormat('m/d/Y', $request->tanggal_presensi)->format('Y-m-d');
            presensi::where('id', $id)->update([
                'tanggal' => $tanggal,
                'waktu_presensi' => $waktu,
                'status' => $request->status,
            ]);
            alert()->success('Success', 'Data Berhasil Diubah');
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi Kesalahan Saat Mengubah Data');
            return redirect()->back()->withInput();
        }
        return redirect()->route('presensi-siswa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $presensi = presensi::where('id', $id)->firstOrFail();
            $presensi->delete();
            alert()->success('Success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            alert()->error('Gagal', 'Terjadi Kesalahan Menghapus Data');
            return redirect()->back();
        }
        return redirect()->route('presensi-siswa.index');
    }
    public function getSiswaByKelas($kelasId)
    {
        $siswa = Siswa::where('kelas_id', $kelasId)->get(['NIS', 'nama_siswa']);
        return response()->json($siswa);
    }
    public function filterByKelas($kelasId)
    {
        $presensi = Presensi::whereHas('siswa', function ($query) use ($kelasId) {
            $query->where('kelas_id', $kelasId);
        })->with('siswa.kelas')->paginate(5);

        return view('pages.presensi-siswa.filtered-kelas', compact('presensi'))->render();
    }
    public function status_presensi()
    {
        $jadwalHariIni = JadwalPresensi::with('kelas')
            ->whereDate('tanggal', Carbon::today())
            ->paginate(10); // ganti jumlah per halaman sesuai kebutuhan

        $jadwalHariIni->getCollection()->transform(function ($jadwal) {
            $now = Carbon::now();
            $jamMulai = Carbon::parse("{$jadwal->tanggal} {$jadwal->jam_mulai}");
            $jamSelesai = Carbon::parse("{$jadwal->tanggal} {$jadwal->jam_selesai}");

            $jadwal->status = $now->between($jamMulai, $jamSelesai) ? 'live' : 'down';

            return $jadwal;
        });

        return view('pages.presensi-siswa.status-presensi', compact('jadwalHariIni'));
    }
}
