<?php

namespace App\Http\Requests\master_data;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreKelasRequest extends FormRequest
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
            'nama_kelas' => 'required',
            'tahun_ajaran' => 'required|numeric',
            'catatan' => 'nullable'

        ];
    }
    public function messages(): array
    {
        return [
            'nama_kelas.required' => 'Nama Kelas Wajib Diisi',
            'tahun_ajaran.required' => 'Tahun Ajaran Wajib Diisi',
            'tahun_ajaran.numeric' => 'Tahun Ajaran Harus Berupa Angka',

        ];
    }
    public function attributes(): array
    {
        return [
            'nama_kelas' => 'nama_kelas',
            'tahun_ajaran' => 'tahun_ajaran',
            'catatan' => 'catatan',
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
