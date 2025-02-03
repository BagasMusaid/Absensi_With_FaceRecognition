<?php

namespace App\Http\Requests\master_data;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreWalikelasRequest extends FormRequest
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
            'guru_id' => 'required|exists:gurus,kd_guru',
            'kelas_id' => 'required|exists:kelas,id',
            'password' => 'required|string|min:8',
        ];
    }
    public function messages(): array
    {
        return [
            'guru_id.required' => 'Harus Pilih Nama Guru',
            'kelas_id.required' => ' Harus Pilih Kelas',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
        ];
    }
    public function attributes(): array
    {
        return [
            'guru_id' => 'guru_id',
            'kelas_id' => 'kelas_id',
            'password' => 'Password',
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