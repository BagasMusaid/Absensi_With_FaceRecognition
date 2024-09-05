<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuruRequest extends FormRequest
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
            'nip' => 'required|unique:gurus',
            'gender' => 'required',
            'tlp' => 'required|max:15',
            'alamat' => 'required|max:225',
            'email' => 'required|email|unique:gurus',
            'password' => 'required|min:8|max:225|alpha_dash'
        ];
    }

    public function message(): array
    {
        return [
            'nama.required' => 'Nama Wajib Diisi',
            'nip.required' => 'NIP Wajib Diisi',
            'nip.unique' => 'NIP Sudah Ada',
            'gender.required' => 'Jenis Kelamin Wajib Diisi',
            'tlp.required' => 'No Telp Wajib Diisi',
            'tlp.max' => 'No Telp Tidak Boleh Lebih Dari 15',
            'alamat.required' => 'Alamat Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'email.email' => 'Email Tidak Valid',
            'email.unique' => 'Email Sudah Ada',
            'password.required' => 'Password Wajib Diisi',
            'password.min' => 'Password Minimal 8 Karakter',
            'password.alpha_dash' => 'Password Hanya Boleh Menggunakan Huruf Dan
    Angka'
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
}
