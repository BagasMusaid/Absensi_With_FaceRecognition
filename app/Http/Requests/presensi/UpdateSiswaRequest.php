<?php

namespace App\Http\Requests\presensi;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateSiswaRequest extends FormRequest
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
        $kd_siswa = $this->route('siswa');
        return [
            'nama_siswa' => 'required|max:225',
            'nis_siswa' => 'required|numeric|digits_between:9,18|unique:siswas,NIS,' . $kd_siswa . ',kd_siswa',
            'gender_siswa' => 'required',
            'nama_kelas' => 'required',
            'agama_siswa' => 'required|max:30',
            'alamat_siswa' => 'required|max:225'
        ];
    }
    public function messages(): array
    {
        return [
            'nama_siswa.required' => 'Nama Siswa Wajib Diisi',
            'nis_siswa.required' => 'NIS Wajib Diisi',
            'nis_siswa.numeric' => 'NIS Harus Berupa Angka',
            'nis_siswa.digits_between' => 'NIS Min 9 Digit dan Max 18 Digit',
            'gender_siswa.required' => 'Jenis Kelamin Wajib Diisi',
            'agama_siswa.required' => 'Agama Wajib Diisi',
            'alamat_siswa.required' => 'Alamat Wajib Diisi',
            'nama_kelas.required' => 'Kelas Wajib Diisi'
        ];
    }
    // public function attributes(): array
    // {
    //     return [
    //         'nama_siswa' => 'nama_siswa',
    //         'nis_siswa' => 'NIS',
    //         'gender_siswa' => 'jenis_kelamin',
    //         'nama_kelas' => 'kelas_id',
    //         'agama_siswa' => 'agama',
    //         'alamat_siswa' => 'alamat'
    //     ];
    // }
    public function failedValidation(Validator $validator)
    {
        alert()->error('Gagal Update Data', 'Periksa Kembali Inputan Anda');
        throw new HttpResponseException(
            redirect()->back()->withErrors($validator)->withInput()
        );
    }
}
