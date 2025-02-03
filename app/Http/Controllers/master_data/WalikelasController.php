<?php

namespace App\Http\Controllers\master_data;

use App\Http\Controllers\Controller;
use App\Http\Requests\master_data\StoreWalikelasRequest;
use App\Models\master_data\kelas;
use App\Models\master_data\Walikelas;
use App\Models\presensi\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WalikelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->search;
        $pickKelasId = Walikelas::pluck('kelas_id')->toArray();
        $pickGuruId = Walikelas::pluck('guru_id')->toArray(); //ambil guru_id yng di tbl_walikelas
        $kelas = kelas::whereNotIn('id', $pickKelasId)->get();
        $gurus = Guru::whereNotIn('kd_guru', $pickGuruId)->get(); //lakukan pengecualian kd_guru yang sudah dipilih
        $walikelasQuery = Walikelas::with('guru');

        if ($search) {
            $walikelasQuery->whereHas('guru', function ($query) use ($search) {
                $query->where('nama_guru', 'like', "%$search%")
                    ->orWhere('NIP', 'like', "%$search%")
                    ->orwhere('email', 'like', "%$search%");
            })->orWhereHas('kelas', function ($query) use ($search) {
                $query->where('nama_kelas', 'like', "%$search%");
            });
        }

        $walikelas = $walikelasQuery->paginate(5);
        if ($request->ajax()) {
            return view('pages.walikelas.index', compact('walikelas', 'gurus', 'search', 'kelas'))->render();
        }

        return view('pages.walikelas.index', compact('gurus', 'walikelas', 'search', 'kelas'));
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
    public function store(StoreWalikelasRequest $request)
    {
        try {
            Walikelas::create($request->validated());
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
