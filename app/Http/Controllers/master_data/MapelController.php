<?php

namespace App\Http\Controllers\master_data;

use App\Http\Controllers\Controller;
use App\Http\Requests\master_data\StoreMapelRequest;
use App\Http\Requests\master_data\UpdateMapelRequest;
use App\Models\master_data\kelas;
use App\Models\master_data\mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mapelQuery = mapel::with('kelas');
        $kelas = kelas::all();
        $mapels = $mapelQuery->paginate(5);

        return view('pages.mapel.index', compact('mapels', 'kelas',));
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
    public function store(StoreMapelRequest $request)
    {
        try {
            $lastMapel = mapel::where('kd_mapel', 'LIKE', 'MP%')->orderBy('kd_mapel', 'desc')->first();

            if ($lastMapel) {
                $lastNumber = (int) str_replace('MP', '', $lastMapel->kd_mapel);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $newKdMapel = 'MP' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
            mapel::create([
                'kd_mapel' => $newKdMapel,
                'nama_mapel' => $request->nama_mapel,
                'kd_kelas' => $request->kd_kelas,
                'hari' => $request->hari,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
            ]);
            alert()->success('Success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            alert()->error('Gagal', 'Terjadi Kesalahan Saat Menambahkan Data');
            return redirect()->back()->withInput();
        }
        return redirect()->route('mapel.index');
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
    public function update(UpdateMapelRequest $request, string $kd_mapel)
    {
        try {
            mapel::where('kd_mapel', $kd_mapel)->update([
                'nama_mapel' => $request->nama_mapel,
                'kd_kelas' => $request->kd_kelas,
                'hari' => $request->hari,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
            ]);
            alert()->success('Success', 'Data Berhasil Diupdate');
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi Kesalahan Saat Mengupdate Data');
            return redirect()->back()->withInput();
        }
        return redirect()->route('mapel.index')->with('refresh', true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $mapels)
    {
        try {
            $mapel = mapel::where('kd_mapel', $mapels)->firstOrFail();
            $mapel->delete();
            alert()->success('Success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi Kesalahan Menghapus Data');
            return redirect()->back();
        }
        return redirect()->route('mapel.index');
    }
}
