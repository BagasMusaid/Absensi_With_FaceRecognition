<?php

namespace App\Http\Controllers\master_data;

use App\Http\Controllers\Controller;
use App\Http\Requests\master_data\StoreTahunAjaranRequest;
use App\Http\Requests\master_data\UpdateTahunAjaranRequest;
use App\Models\master_data\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $ta = TahunAjaran::query();
        if ($search) {
            $ta->where(function ($query) use ($search) {
                $query->where('tahun_mulai', 'like', "%$search%")
                    ->orWhere('tahun_selesai', 'like', "%$search%")
                    ->orWhere('semester', 'like', "%$search%");
            });
        }
        $tahunAjaran = $ta->latest()->orderBy('tahun_mulai', 'desc')->paginate(5);
        if ($request->ajax()) {
            return view('pages.tahun-ajaran.index', compact('tahunAjaran'))->render();
        }

        return view('pages.tahun-ajaran.index', compact('tahunAjaran'));
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
    public function store(StoreTahunAjaranRequest $request)
    {
        try {
            TahunAjaran::create($request->validated());
            alert()->success('Success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            alert()->error('Gagal', 'Terjadi Kesalahan Saat Menambahkan Data');
        }
        return redirect()->route('tahun-ajaran.index');
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
    public function update(UpdateTahunAjaranRequest $request, string $id)
    {
        try {
            $tahunAjaran = TahunAjaran::findOrFail($id);
            $tahunAjaran->update($request->validated());

            alert()->success('Berhasil', 'Data Tahun Ajaran Berhasil Diperbarui');
            return redirect()->route('tahun-ajaran.index');
        } catch (\Exception $e) {
            alert()->error('Gagal', 'Terjadi kesalahan saat mengupdate data');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
