<?php

namespace App\Http\Requests\master_data;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateGuruPiketRequest extends FormRequest
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
            'guru_id' => 'required',
            'kd_tahun_ajaran' => 'required',
            'hari' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'guru_id.required' => 'Nama guru harus diisi!',
            'kd_tahun_ajaran.required' => 'Kode tahun ajaran harus diisi!',
            'hari.required' => 'Hari harus diisi!',
        ];
    }
    public function attributes(): array
    {
        return [
            'guru_id' => 'guru_id',
            'kd_tahun_ajaran' => 'kd_tahun_ajaran',
            'hari' => 'hari'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        alert()->error('Gagal Ubah Data', 'Periksa Kembali Inputan Anda');
        throw new HttpResponseException(
            redirect()->back()->withErrors($validator)->withInput()
        );
    }
}
