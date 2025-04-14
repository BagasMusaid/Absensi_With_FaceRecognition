<?php

namespace App\Http\Requests\presensi;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdatePresensiRequest extends FormRequest
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
            'waktu' => 'required|date_format:H:i',
            'tanggal_presensi' => 'required|date',
            'status' => 'required|in:Hadir,Alpha,Sakit,Izin',
        ];
    }
    public function messages(): array
    {
        return [
            'waktu.required' => 'Waktu tidak boleh kosong',
            'waktu.date_format' => 'Format waktu tidak sesuai',
            'tanggal_presensi.required' => 'Tanggal tidak boleh kosong',
            'tanggal_presensi.date' => 'Format tanggal tidak sesuai',
            'status.required' => 'Status tidak boleh kosong',
            'status.in' => 'Status tidak sesuai',
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
