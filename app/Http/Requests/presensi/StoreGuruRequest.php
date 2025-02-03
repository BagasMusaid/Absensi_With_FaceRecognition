<?php

namespace App\Http\Requests\presensi;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreGuruRequest extends FormRequest
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
            'nip' => 'required|numeric|digits_between:9,18|unique:gurus',
            'gender' => 'required',
            'tlp' => 'required|numeric|digits_between:10,14',
            'alamat' => 'required|max:225',
            'email' => 'required|email|unique:gurus',
            'password' => 'required|min:8|max:225|alpha_dash'
        ];
    }
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama Wajib Diisi',
            'nip.required' => 'NIP Wajib Diisi',
            'nip.numeric' => 'NIP Harus Angka',
            'nip.digits_between' => 'NIP min 9 digit dan max 18 digit',
            'nip.unique' => 'NIP Sudah Ada',
            'gender.required' => 'Jenis Kelamin Wajib Diisi',
            'tlp.required' => 'No Telp Wajib Diisi',
            'tlp.numeric' => 'No Telp Harus Angka',
            'tlp.digits_between' => 'No Telp min 10 digit dan max 14 digit',
            'alamat.required' => 'Alamat Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'email.email' => 'Email Tidak Valid',
            'email.unique' => 'Email Sudah Ada',
            'password.required' => 'Password Wajib Diisi',
            'password.min' => 'Password Minimal 8 Karakter',
            'password.alpha_dash' => 'Password Hanya Boleh Menggunakan Huruf Dan Angka'
        ];
    }
    public function attributes(): array
    {
        return [
            'nama' => 'nama_guru',
            'nip' => 'NIP',
            'gender' => 'jenis_kelamin',
            'tlp' => 'no_telp',
            'alamat' => 'alamat',
            'email' => 'email',
            'password' => 'password'
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
