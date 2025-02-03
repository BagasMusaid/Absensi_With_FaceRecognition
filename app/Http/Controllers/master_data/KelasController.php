<?php

namespace App\Http\Controllers\master_data;

use App\Http\Controllers\Controller;
use App\Http\Requests\master_data\StoreKelasRequest;
use App\Http\Requests\master_data\UpdateKelasRequest;
use App\Models\master_data\kelas;
use App\Models\master_data\Walikelas;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        // $pickWkId = Kelas::pluck('walikelas_id')->toArray();
        // $walas = Walikelas::with('guru')->whereNotIn('id', $pickWkId)->get();  // Mengambil wali kelas yang belum digunakan
        $kelasQuery = Kelas::query();
        if ($search) {
            $kelasQuery->where(function ($query) use ($search) {
                $query->where('nama_kelas', 'like', "%$search%")
                    ->orWhere('tahun_ajaran', 'like', "%$search%")
                    ->orWhere('catatan', 'like', "%$search%");
            });
        }
        $kelas = $kelasQuery->paginate(5);
        if ($request->ajax()) {
            return view('pages.kelas.index', compact('kelas'))->render();
        }


        return view('pages.kelas.index', compact('kelas'));
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
    public function store(StoreKelasRequest $request)
    {
        try {
            kelas::create($request->validated());
            alert()->success('Success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            alert()->error('Gagal', 'Terjadi Kesalahan Saat Menambahkan Data');
        }
        return redirect()->route('kelas.index');
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
    public function update(UpdateKelasRequest $request, string $id)
    {
        try {
            kelas::where('id', $id)->update([
                'nama_kelas' => $request->nama_kelass,
                'tahun_ajaran' => $request->tahun_ajaran,
                'catatan' => $request->catatan
            ]);
            alert()->success('Berhasil', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            alert()->error('Gagal', 'Terjadi Kesalahan Update Data');
        }
        return redirect()->route('kelas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $kela)
    {
        try {
            $kelas = kelas::where('id', $kela)->firstOrFail();
            $kelas->delete();
            alert()->success('Berhasil', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi Kesalahan Menghapus Data');
        }
        return redirect()->route('kelas.index');
    }
}
