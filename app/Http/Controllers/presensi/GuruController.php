<?php

namespace App\Http\Controllers\presensi;

use App\Http\Controllers\Controller;
use App\Models\presensi\Guru;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $guruQuery = Guru::query();
        if ($search) {
            $guruQuery->where(function ($query) use ($search) {
                $query->where('nama_guru', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        };

        $datas = $guruQuery->paginate(5);
        
        if ($request->ajax()) {
            return view('pages.guru.index', compact('datas'))->render();
        }

        return view('pages.guru.index', compact('datas'));
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
            'nama' => 'required|max:225',
            'nip' => 'required|numeric|digits_between:9,18|unique:gurus',
            'gender' => 'required',
            'tlp' => 'required|numeric|digits_between:10,14',
            'alamat' => 'required|max:225',
            'email' => 'required|email|unique:gurus',
            'password' => 'required|min:8|max:225|alpha_dash'
        ], [
            'nama.required' => 'Nama Wajib Diisi',
            'nip.required' => 'NIP Wajib Diisi',
            'nip.numeric' => 'NIP Harus Angka',
            'nip.digits_between' => 'NIP min 9 digit dan max 18 digit',
            'nip.unique' => 'NIP Sudah Ada',
            'gender.required' => 'Jenis Kelamin Wajib Diisi',
            'tlp.required' => 'No Telp Wajib Diisi',
            'tlp.numeric' => 'No Telp Harus Angka',
            'tlp.digits_between' => 'No Telp min 10 digit dan max 14 digit',
            'alamat.required' => 'Alamat Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'email.email' => 'Email Tidak Valid',
            'email.unique' => 'Email Sudah Ada',
            'password.required' => 'Password Wajib Diisi',
            'password.min' => 'Password Minimal 8 Karakter',
            'password.alpha_dash' => 'Password Hanya Boleh Menggunakan Huruf Dan Angka'
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal Tambah Data', 'Periksa Kembali Inputan Anda');
            return redirect()->back()->withInput()->withErrors($validator);
        }
        try {
            // Ambil data guru terakhir berdasarkan kd_guru yang memiliki awalan "GR"
            $latestGuru = Guru::where('kd_guru', 'LIKE', 'GR%')->orderBy('kd_guru', 'desc')->first();

            if ($latestGuru) {
                $lastNumber = (int) str_replace('GR', '', $latestGuru->kd_guru);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $newKdGuru = 'GR' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
            Guru::create(
                [
                    'kd_guru' => $newKdGuru,
                    'nama_guru' =>  $request->nama,
                    'NIP' => $request->nip,
                    'jenis_kelamin' => $request->gender,
                    'no_telp' => $request->tlp,
                    'alamat' => $request->alamat,
                    'email' => $request->email,
                    'password' => $request->password
                ]
            );
            alert()->success('Success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput();
        }
        return redirect()->route('guru.index');
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
    public function update(Request $request, string $kd_guru)
    {
        $validator = Validator::make($request->all(), [
            'nama_guru' => 'required|max:225',
            'nip_guru' => 'required|numeric|digits_between:9,18|unique:gurus,NIP,' . $kd_guru . ',kd_guru',
            'gender_guru' => 'required',
            'tlp_guru' => 'required|numeric|digits_between:10,14',
            'alamat_guru' => 'required|max:225',
            'email_guru' => 'required|email|unique:gurus,email,' . $kd_guru . ',kd_guru',
        ], [
            'nama_guru.required' => 'Nama Wajib Diisi',
            'nip_guru.required' => 'NIP Wajib Diisi',
            'nip_guru.unique' => 'NIP Sudah Ada',
            'nip_guru.numeric' => 'NIP Harus Berupa Angka',
            'nip_guru.digits_between' => 'NIP Min 9 Digit dan Max 18 Digit',
            'gender_guru.required' => 'Jenis Kelamin Wajib Diisi',
            'tlp_guru.required' => 'No Telp Wajib Diisi',
            'tlp_guru.numeric' => 'No Telp Harus Berupa Angka',
            'tlp_guru.digits_between' => 'No Telp Min 10 Digit dan Max 14 Digit',
            'tlp_guru.max' => 'No Telp Tidak Boleh Lebih Dari 15',
            'alamat_guru.required' => 'Alamat Wajib Diisi',
            'email_guru.required' => 'Email Wajib Diisi',
            'email_guru.email' => 'Email Tidak Valid',
            'email_guru.unique' => 'Email Sudah Ada',
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal Update Data', 'Periksa Kembali Inputan Anda');
            return redirect()->back()->withInput()->withErrors($validator);
        }

        try {
            Guru::where('kd_guru', $kd_guru)->update([
                'nama_guru' => $request->nama_guru,
                'NIP' => $request->nip_guru,
                'jenis_kelamin' => $request->gender_guru,
                'no_telp' => $request->tlp_guru,
                'alamat' => $request->alamat_guru,
                'email' => $request->email_guru,
            ]);
            alert()->success('Success', 'Data Berhasil Diupdate');
        } catch (\Exception $e) {
            alert()->error('Gagal', 'Terjadi Kesalahan Saat Menambahkan Data');
            return redirect()->back()->withInput();
        }

        return redirect()->route('guru.index')->with('refresh', true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kd_guru)
    {
        try {
            $guru = Guru::where('kd_guru', $kd_guru)->firstOrFail();
            $guru->delete();
            alert()->success('Success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            alert()->error('Gagal', 'Terjadi Kesalahan Menghapus Data');
            return redirect()->back();
        }
        return redirect()->route('guru.index');
    }
}