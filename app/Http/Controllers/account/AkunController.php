<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.akun.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function update_profil(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg|max:3048',
        ], [
            'foto_profil.required' => 'Foto profil wajib diunggah.',
            'foto_profil.image' => 'File yang diunggah harus berupa gambar.',
            'foto_profil.mimes' => 'Format gambar harus berjenis JPEG, PNG, atau JPG.',
            'foto_profil.max' => 'Ukuran gambar maksimal 3MB.',
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal Tambah Data', 'Periksa Kembali Inputan Anda');
            return back()->withErrors($validator)->withInput();
        }

        $wali = Auth::guard('wali')->user();
        if ($wali->guru && $wali->guru->foto_profil) {
            Storage::delete('public/profil_wali/' . $wali->guru->foto_profil);
        }

        // Menyimpan foto profil baru
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profil_wali', $filename);

            $wali->guru->update(['foto_profil' => $filename]);
            alert()->success('Success', 'Foto Profil Berhasil Diperbarui');
        }
        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
    }
    public function update_data(Request $request, string $id)
    {
        try {
            $wali = Auth::guard('wali')->user();
            $kd_guru = $wali->guru->kd_guru ?? null;
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'alamat' => 'required|max:225',
                'email' => 'required|email|unique:gurus,email,' . $kd_guru . ',kd_guru',
                'gender' => 'required'
            ], [
                'nama.required' => 'Nama Wajib Diisi',
                'alamat.required' => 'Alamat Wajib Diisi',
                'alamat.max' => 'Alamat Maksimal 225 Karakter',
                'email.required' => 'Email Wajib Diisi',
                'email.email' => 'Format Email Tidak Sesuai',
                'email.unique' => 'Email Sudah Terdaftar',
                'gender.required' => 'Jenis Kelamin Wajib Diisi'
            ]);
            if ($validator->fails()) {
                alert()->error('Gagal Tambah Data', 'Periksa Kembali Inputan Anda');
                return back()->withErrors($validator)->withInput();
            }
            $wali->guru->update([
                'nama_guru' => $request->nama,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'jenis_kelamin' => $request->gender
            ]);
            alert()->success('Sukses', 'Data berhasil diperbarui');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Gagal', 'Terjadi Kesalahan Saat Mengupdate Data');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
