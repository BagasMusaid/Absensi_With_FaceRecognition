<?php

namespace App\Http\Requests\presensi;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreJadwalPresensi extends FormRequest
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
            'kelas_id' => 'required|exists:kelas,id',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ];
    }
    public function messages(): array
    {
        return [
            'kelas_id.required'     => 'Kelas harus dipilih.',
            'jam_mulai.required'    => 'Jam mulai tidak boleh kosong.',
            'jam_selesai.required'     => 'Jam selesai tidak boleh kosong.',
            'jam_selesai.after'        => 'Jam selesai harus setelah jam mulai.',
        ];
    }
    public function attributes(): array
    {
        return [
            'kelas_id' => 'kelas_id',
            'jam_mulai' => 'jam_mulai',
            'jam_selesai' => 'jam_selesai'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        // Menampilkan SweetAlert ketika validasi gagal
        alert()->error('Gagal Menyimpan Data', 'Periksa Kembali Inputan Anda');

        throw new HttpResponseException(
            redirect()->back()->withErrors($validator)->withInput()
        );
    }
}
