<?php

namespace App\Http\Requests\master_data;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreMapelRequest extends FormRequest
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
            'nama_mapel' => 'required',
            'kd_kelas' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'nama_mapel.required' => 'Nama Mapel Wajib Diisi',
            'kd_kelas.required' => 'Kelas Wajib Diisi',
            'hari.required' => 'Hari Wajib Diisi',
            'jam_mulai.required' => 'Jam Mulai Wajib Diisi',
            'jam_selesai.required' => 'Jam Selesai Wajib Diisi',
        ];
    }
    public function attributes(): array
    {
        return [
            'nama_mapel' => 'nama_mapel',
            'kd_kelas' => 'kd_kelas',
            'hari' => 'hari',
            'jam_mulai' => 'jam_mulai',
            'jam_selesai' => 'jam_selesai',
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
