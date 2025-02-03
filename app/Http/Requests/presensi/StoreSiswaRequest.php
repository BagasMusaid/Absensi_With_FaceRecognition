<?php

namespace App\Http\Requests\presensi;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreSiswaRequest extends FormRequest
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
            'nama' => 'required|max:225',
            'nis' => 'required|numeric|digits_between:9,18|unique:siswas',
            'gender' => 'required',
            'agama' => 'required|max:30',
            'alamat' => 'required|max:225',
            'kelas_id' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama Siswa Wajib Diisi',
            'nis.required' => 'NIS Wajib Diisi',
            'nis.numeric' => 'NIS Harus Berupa Angka',
            'nis.digits_between' => 'NIS Min 9 Digit dan Max 18 Digit',
            'gender.required' => 'Jenis Kelamin Wajib Diisi',
            'agama.required' => 'Agama Wajib Diisi',
            'alamat.required' => 'Alamat Wajib Diisi',
            'kelas_id.required' => 'Kelas Wajib Diisi'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        alert()->error('Gagal Tambah Data', 'Periksa Kembali Inputan Anda');
        throw new HttpResponseException(
            redirect()->back()->withErrors($validator)->withInput()
        );
    }
}
