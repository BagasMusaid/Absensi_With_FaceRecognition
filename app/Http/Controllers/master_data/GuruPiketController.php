<?php

namespace App\Http\Controllers\master_data;

use App\Http\Controllers\Controller;
use App\Http\Requests\master_data\StoreGuruPiketRequest;
use App\Http\Requests\master_data\UpdateGuruPiketRequest;
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
    public function index(Request $request)
    {
        $search = $request->search;
        $pickGuruId = GuruPiket::pluck('guru_id')->toArray();
        $gurus = Guru::whereNotIn('kd_guru', $pickGuruId)->get();
        $tahunAjaran = TahunAjaran::all();
        $GPQuery = GuruPiket::with('guru');
        if ($search) {
            $GPQuery->where(function ($query) use ($search) {
                $query->where('hari', 'like', "%$search%")
                    ->orWhereHas('guru', function ($query) use ($search) {
                        $query->where('nama_guru', 'like', "%$search%");
                    })
                    ->orWhereHas('tahun_ajaran', function ($query) use ($search) {
                        $query->where('tahun_mulai', 'like', "%$search%")
                            ->orWhere('tahun_selesai', 'like', "%$search%");
                    });
            });
        }
        $guruPiket = $GPQuery->paginate(5);
        if ($request->ajax()) {
            return view('pages.guru-piket.index', compact('tahunAjaran', 'gurus', 'guruPiket'))->render();
        }
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
    public function update(UpdateGuruPiketRequest $request, string $id)
    {

        try {
            GuruPiket::findOrFail($id)->update($request->validated());
            alert()->success('Berhasil', 'Data Guru Piket Berhasil Diperbarui');
            return redirect()->route('guru-piket.index');
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
        try {
            GuruPiket::findOrFail($id)->delete();
            alert()->success('Berhasil', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Data Gagal Dihapus');
        }
        return redirect()->route('guru-piket.index');
    }
}
