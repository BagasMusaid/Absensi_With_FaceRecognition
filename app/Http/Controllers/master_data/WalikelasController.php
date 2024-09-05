<?php

namespace App\Http\Controllers\master_data;

use App\Http\Controllers\Controller;
use App\Models\master_data\Walikelas;
use App\Models\presensi\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WalikelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $search = $request->search;
            $pickGuruId = Walikelas::pluck('guru_id')->toArray(); //ambil guru_id yng di tbl_walikelas
            $gurus = Guru::whereNotIn('kd_guru', $pickGuruId)->get(); //lakukan pengecualian kd_guru yang sudah dipilih
            $walikelasQuery = Walikelas::with('guru');

            if ($search) {
                $walikelasQuery->whereHas('guru', function ($query) use ($search) {
                    $query->where('nama_guru', 'like', "%$search%")
                        ->orWhere('NIP', 'like', "%$search%")
                        ->orwhere('email', 'like', "%$search%");
                });
            }

            $walikelas = $walikelasQuery->paginate(10);

            return view('pages.walikelas.index', compact('gurus', 'walikelas', 'search'));
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'guru_id' => 'required|exists:gurus,kd_guru',
            'password' => 'required|string|min:8',
        ], [
            'guru_id.required' => 'Harus Pilih Nama Guru',
            'password.required' => 'Paswword tidak boleh kosong',
            'password.min' => 'Paswword minimal 8 karakter',
        ]);
        if ($validator->fails()) {
            alert()->error('Gagal Tambah Data', 'Periksa Kembali Inputan Anda');
            return redirect()->back()->withInput()->withErrors($validator);
        }


        try {
            Walikelas::create([
                'guru_id' => $request->guru_id,
                'password' => $request->password
            ]);
            alert()->success('Success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi Kesalahan Saat Menambahkan Data');
        }
        return redirect()->route('walikelas.index');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $walikela)
    {
        try {
            $walikelas = Walikelas::where('id', $walikela)->firstOrFail();
            $walikelas->delete();
            alert()->success('Berhasil', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Gagal Menghapus Data');
        }
        return redirect()->route('walikelas.index');
    }
}
