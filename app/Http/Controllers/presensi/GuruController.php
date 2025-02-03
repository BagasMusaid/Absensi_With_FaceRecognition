<?php

namespace App\Http\Controllers\presensi;

use App\Http\Controllers\Controller;
use App\Http\Requests\presensi\StoreGuruRequest;
use App\Http\Requests\presensi\UpdateGuruRequest;
use App\Models\presensi\Guru;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $guruQuery = Guru::query();
        if ($search) {
            $guruQuery->where(function ($query) use ($search) {
                $query->where('nama_guru', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('NIP', 'like', "%$search%");
            });
        };

        $datas = $guruQuery->latest()->paginate(5);

        if ($request->ajax()) {
            return view('pages.guru.index', compact('datas'))->render();
        }

        return view('pages.guru.index', compact('datas'));
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
    public function store(StoreGuruRequest $request)
    {
        try {
            // Ambil data guru terakhir berdasarkan kd_guru yang memiliki awalan "GR"
            $latestGuru = Guru::where('kd_guru', 'LIKE', 'GR%')->orderBy('kd_guru', 'desc')->first();

            if ($latestGuru) {
                $lastNumber = (int) str_replace('GR', '', $latestGuru->kd_guru);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $newKdGuru = 'GR' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
            Guru::create(
                [
                    'kd_guru' => $newKdGuru,
                    'nama_guru' =>  $request->nama,
                    'NIP' => $request->nip,
                    'jenis_kelamin' => $request->gender,
                    'no_telp' => $request->tlp,
                    'alamat' => $request->alamat,
                    'email' => $request->email,
                    'password' => $request->password
                ]
            );
            alert()->success('Success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput();
        }
        return redirect()->route('guru.index');
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
    public function update(UpdateGuruRequest $request, string $kd_guru)
    {
        try {
            Guru::where('kd_guru', $kd_guru)->update([
                'nama_guru' => $request->nama_guru,
                'NIP' => $request->nip_guru,
                'jenis_kelamin' => $request->gender_guru,
                'no_telp' => $request->tlp_guru,
                'alamat' => $request->alamat_guru,
                'email' => $request->email_guru,
            ]);
            alert()->success('Success', 'Data Berhasil Diupdate');
        } catch (\Exception $e) {
            alert()->error('Gagal', 'Terjadi Kesalahan Saat Mengupdate Data');
            return redirect()->back()->withInput();
        }

        return redirect()->route('guru.index')->with('refresh', true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kd_guru)
    {
        try {
            $guru = Guru::where('kd_guru', $kd_guru)->firstOrFail();
            $guru->delete();
            alert()->success('Success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            alert()->error('Gagal', 'Terjadi Kesalahan Menghapus Data');
            return redirect()->back();
        }
        return redirect()->route('guru.index');
    }
}
