<?php

namespace App\Http\Controllers\master_data;

use App\Http\Controllers\Controller;
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
        $pickWkId = Kelas::pluck('walikelas_id')->toArray();
        $walas = Walikelas::with('guru')->whereNotIn('id', $pickWkId)->get();  // Mengambil wali kelas yang belum digunakan
        $kelasQuery = Kelas::with('walikelas.guru');
        if ($search) {
            $kelasQuery->where(function ($query) use ($search) {
                $query->where('nama_kelas', 'like', "%$search%")
                    ->orWhereHas('walikelas.guru', function ($query) use ($search) {
                        $query->where('nama_guru', 'like', "%$search%");
                    });
            });
        }
        $kelas = $kelasQuery->paginate(5);


        return view('pages.kelas.index', compact('walas', 'kelas'));
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

        $validate = Validator::make($request->all(), [
            'nama_kelas' => 'required',
            'walikelas_id' => 'required|exists:walikelas,id'
        ], [
            'nama_kelas.regex' => 'Nama Kelas tidak valid',
            'nama_kelas.required' => 'Nama Kelas Wajib Diisi',
            'walikelas_id.required' => 'Silahkan Pilih Nama Walikelas',
        ]);

        if ($validate->fails()) {
            alert()->error('Gagal Tambah Data', 'Periksa Kembali Inputan Anda');
            return redirect()->back()->withInput()->withErrors($validate)->with('refresh', true);
        }
        try {
            $kelas = kelas::create($request->all());
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
    public function update(Request $request, string $id)
    {
        $validasi = Validator::make($request->all(), [
            'nama_kelass' => 'required',
            'nama_walas' => 'required|exists:walikelas,id'
        ], [
            'nama_kelass.required' => 'Nama Kelas Wajib Diisi',
            'nama_walas.required' => 'Silahkan Pilih Nama Walikelas Baru'
        ]);

        if ($validasi->fails()) {
            alert()->error('Gagal Update Data', 'Periksa Kembali Inputan Anda');
            return redirect()->back()->withInput()->withErrors($validasi)->with('refresh', true);
        };

        try {
            kelas::where('id', $id)->update([
                'nama_kelas' => $request->nama_kelass,
                'walikelas_id' => $request->nama_walas
            ]);
            alert()->success('Berhasil', 'Data Berhasil Diubah');
        } catch (\Throwable $th) {
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
