<?php

namespace App\Http\Requests\master_data;

use Dotenv\Validator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTahunAjaranRequest extends FormRequest
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
            'tahun_mulai' => 'required|numeric',
            'tahun_selesai' => 'required|numeric',
            'semester' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'tahun_mulai.required' => 'Tahun Ajaran Mulai Wajib Diisi',
            'tahun_selesai.required' => 'Tahun Ajaran Selesai Wajib Diisi',
            'tahun_mulai.numeric' => 'Tahun Ajaran Mulai Harus Berupa Angka',
            'tahun_selesai.numeric' => 'Tahun Ajaran Selesai Harus Berupa Angka',
            'semester.required' => 'Semester Wajib Diisi'
        ];
    }
    public function attributes(): array
    {
        return [
            'tahun_mulai' => 'tahun_mulai',
            'tahun_selesai' => 'tahun_selesai',
            'semester' => 'semester',
        ];
    }
    public function failedValidation(ValidationValidator $validator)
    {
        alert()->error('Gagal Tambah Data', 'Periksa Kembali Inputan Anda');
        throw new HttpResponseException(
            redirect()->back()->withErrors($validator)->withInput()
        );
    }
}
