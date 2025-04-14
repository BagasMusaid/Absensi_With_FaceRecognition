<?php

namespace App\Http\Requests\presensi;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class StorePresensiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kd_kelas' => 'required',
            'nis_siswa' => 'required|exists:siswas,NIS',
            'tanggal' => 'required|date',
            'status' => 'required|in:Hadir,Alpha,Sakit,Izin',
        ];
    }
    public function messages(): array
    {
        return [
            'kd_kelas.required' => 'Kelas wajib diisi',
            'nis_siswa.required' => 'Nama Siswa tidak boleh kosong',
            'nis_siswa.exists' => 'Nama Siswa tidak ditemukan',
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'tanggal.date' => 'Tanggal tidak valid',
            'status.required' => 'Status tidak boleh kosong',
            'status.in' => 'Status tidak valid',
        ];
    }
    public function attributes(): array
    {
        return [
            'nis_siswa' => 'nis_siswa',
            'tanggal' => 'tanggal',
            'status' => 'status'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        // Menampilkan SweetAlert ketika validasi gagal
        alert()->error('Gagal Tambah Data', 'Periksa Kembali Inputan Anda');

        throw new HttpResponseException(
            redirect()->back()->withErrors($validator)->withInput()
        );
    }
}
