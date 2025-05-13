<?php

namespace App\Http\Controllers\presensi;

use App\Http\Controllers\Controller;
use App\Http\Requests\presensi\StoreSiswaRequest;
use App\Http\Requests\presensi\UpdateSiswaRequest;
use App\Models\master_data\kelas;
use App\Models\presensi\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $querySiswa = Siswa::with('kelas');

        if ($search) {
            $querySiswa->where(function ($query) use ($search) {
                $query->where('nama_siswa', 'like', "%$search%")
                    ->orWhere('NIS', 'like', "%$search%")
                    ->orWhereHas('kelas', function ($query) use ($search) {
                        $query->where('nama_kelas', 'like', "%$search%");
                    });
            });
        }

        $datas = $querySiswa->paginate(5);
        $kelas = kelas::all();


        if ($request->ajax()) {
            return view('pages.siswa.index', compact('datas', 'kelas'))->render();
        }
        return view('pages.siswa.index', compact('datas', 'kelas'));
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
    public function store(StoreSiswaRequest $request)
    {
        try {
            $latestSiswa = Siswa::where('kd_siswa', 'LIKE', 'SA%')->orderBy('kd_siswa', 'desc')->first();

            if ($latestSiswa) {
                $lastNumber = (int) str_replace('SA', '', $latestSiswa->kd_siswa);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $newKdSiswa = 'SA' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
            Siswa::create([
                'kd_siswa' => $newKdSiswa,
                'kelas_id' => $request->kelas_id,
                'nama_siswa' => $request->nama,
                'NIS' => $request->nis,
                'jenis_kelamin' => $request->gender,
                'agama' => $request->agama,
                'alamat' => $request->alamat
            ]);
            alert()->success('Success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi Kesalahan Saat Menambahkan Data');
            return redirect()->back()->withInput();
        }
        return redirect()->route('siswa.index');
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
    public function update(UpdateSiswaRequest $request, string $kd_siswa)
    {
        try {
            Siswa::where('kd_siswa', $kd_siswa)->update([
                'kelas_id' => $request->nama_kelas,
                'nama_siswa' => $request->nama_siswa,
                'NIS' => $request->nis_siswa,
                'jenis_kelamin' => $request->gender_siswa,
                'agama' => $request->agama_siswa,
                'alamat' => $request->alamat_siswa
            ]);
            alert()->success("Berhasil", 'Data Berhasil Diupdate');
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi Kesalahan Saat Mengupdate Data');
            return redirect()->back()->withInput();
        }
        return redirect()->route('siswa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $siswa)
    {
        try {
            $idSiswa = Siswa::where('kd_siswa', $siswa)->firstOrFail();
            $idSiswa->delete();
            alert()->success('Success', 'Data Berhasil Dihapus');
        } catch (\Exception $th) {
            alert()->error('Gagal', 'Terjadi Kesalahan Menghapus Data');
        }
        return redirect()->route('siswa.index');
    }
    public function filterByKelas($kelasId)
    {
        $siswa = Siswa::with('kelas')->where('kelas_id', $kelasId)->paginate(5);
        $kelas = kelas::all();

        return view('pages.siswa.filtered-kelas', compact('siswa', 'kelas'))->render();
    }
}
