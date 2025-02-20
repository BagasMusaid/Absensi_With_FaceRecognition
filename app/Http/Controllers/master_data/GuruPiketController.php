<?php

namespace App\Http\Controllers\master_data;

use App\Http\Controllers\Controller;
use App\Http\Requests\master_data\StoreGuruPiketRequest;
use App\Http\Requests\presensi\StoreGuruRequest;
use App\Models\master_data\GuruPiket;
use App\Models\master_data\TahunAjaran;
use App\Models\presensi\Guru;
use Illuminate\Http\Request;

class GuruPiketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pickGuruId = GuruPiket::pluck('guru_id')->toArray();
        $gurus = Guru::whereNotIn('kd_guru', $pickGuruId)->get();
        $guruPiket = GuruPiket::with('guru')->paginate(5);
        $tahunAjaran = TahunAjaran::all();
        return view('pages.guru-piket.index', compact('tahunAjaran', 'gurus', 'guruPiket'));
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
    public function store(StoreGuruPiketRequest $request)
    {
        try {
            GuruPiket::create($request->validated());
            alert()->success('Success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi Kesalahan Saat Menambahkan Data');
        }
        return redirect()->route('guru-piket.index');
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
    public function destroy(string $id)
    {
        //
    }
}
