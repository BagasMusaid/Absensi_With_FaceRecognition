<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use App\Models\master_data\GuruPiket;
use App\Models\master_data\Walikelas;
use App\Models\presensi\Guru;
use App\Models\User;
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
        $guards = ['wali', 'guru_piket', 'gurus', 'web'];
        $user = null;
        $activeGuard = null;
        $param = null;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
                $activeGuard = $guard;
                break;
            }
        }
        if ($user) {
            $param = ($activeGuard === 'gurus') ? $user->kd_guru : $user->id;
        }

        return view('pages.akun.index', compact('user', 'activeGuard', 'param'));
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

        // Ambil pengguna yang sedang login berdasarkan guard
        if (Auth::guard('wali')->check()) {
            $user = Auth::guard('wali')->user();
            $model = Walikelas::where('id', $user->id)->first();
            $folder = 'public/profil_wali';
        } elseif (Auth::guard('guru_piket')->check()) {
            $user = Auth::guard('guru_piket')->user();
            $model = GuruPiket::where('id', $user->id)->first();
            $folder = 'public/profil_guru_piket';
        } elseif (Auth::guard('gurus')->check()) {
            $user = Auth::guard('gurus')->user();
            $model = Guru::where('kd_guru', $user->kd_guru)->first();
            $folder = 'public/profil_guru';
        } elseif (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            $model = user::where('id', $user->id)->first();
            $folder = 'public/profil_admin';
        } else {
            return back()->with('error', 'Tidak dapat mengidentifikasi pengguna.');
        }

        // Pastikan model ditemukan sebelum update
        if (!$model) {
            return back()->with('error', 'Data tidak ditemukan.');
        }

        // Hapus foto lama jika ada
        if ($model->foto_profil) {
            Storage::delete($folder . '/' . $model->foto_profil);
        }

        // Simpan foto baru
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs($folder, $filename);
            // dd('User:', $user, 'Model:', $model);
            // Update foto_profil di database
            $model->update(['foto_profil' => $filename]);

            alert()->success('Success', 'Foto Profil Berhasil Diperbarui');
        }

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
    }
    public function update_data(Request $request, string $id)
    {
        try {
            // Menentukan guard yang sedang aktif
            $guards = ['wali', 'guru_piket', 'gurus', 'web'];
            $user = null;
            $guardAktif = null;
            foreach ($guards as $guard) {
                if (Auth::guard($guard)->check()) {
                    $guardAktif = $guard;
                    $user = Auth::guard($guard)->user();
                    break;
                }
            }

            // Jika tidak ada guard yang aktif, kembalikan error
            if (!$user) {
                alert()->error('Gagal', 'Anda tidak memiliki izin untuk melakukan tindakan ini.');
                return redirect()->back();
            }

            if ($guardAktif === 'gurus') {
                $guru = Guru::find($id); // Ambil langsung dari tabel gurus
            } else {
                $guru = $user->guru ?? null;
            }

            // Jika tidak ada data guru, kembalikan error
            if (!$guru) {
                alert()->error('Gagal', 'Data guru tidak ditemukan untuk user ini.');
                return redirect()->back();
            }

            // Validasi data
            $rules = [
                'nama' => 'required',
                'alamat' => 'required|max:225',
                'gender' => 'required'
            ];

            // Tambahkan validasi unique jika email diubah
            if ($request->email !== $guru->email) {
                $rules['email'] = 'required|email|unique:gurus,email';
            } else {
                $rules['email'] = 'required|email';
            }

            // Validasi data
            $validator = Validator::make($request->all(), $rules, [
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

            // Update data guru
            $guru->update([
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
