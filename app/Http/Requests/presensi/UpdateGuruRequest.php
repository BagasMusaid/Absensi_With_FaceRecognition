<?php

namespace App\Http\Requests\presensi;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateGuruRequest extends FormRequest
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
        $kd_guru = $this->route('guru') ? $this->route('guru') : null;
        return [
            'nama_guru' => 'required|max:225',
            'nip_guru' => 'required|numeric|digits_between:9,18|unique:gurus,NIP,' . $kd_guru . ',kd_guru',
            'gender_guru' => 'required',
            'tlp_guru' => 'required|numeric|digits_between:10,14',
            'alamat_guru' => 'required|max:225',
            'email_guru' => 'required|email|unique:gurus,email,' . $kd_guru . ',kd_guru',
        ];
    }
    public function messages(): array
    {
        return [
            'nama_guru.required' => 'Nama Wajib Diisi',
            'nip_guru.required' => 'NIP Wajib Diisi',
            'nip_guru.unique' => 'NIP Sudah Ada',
            'nip_guru.numeric' => 'NIP Harus Berupa Angka',
            'nip_guru.digits_between' => 'NIP Min 9 Digit dan Max 18 Digit',
            'gender_guru.required' => 'Jenis Kelamin Wajib Diisi',
            'tlp_guru.required' => 'No Telp Wajib Diisi',
            'tlp_guru.numeric' => 'No Telp Harus Berupa Angka',
            'tlp_guru.digits_between' => 'No Telp Min 10 Digit dan Max 14 Digit',
            'tlp_guru.max' => 'No Telp Tidak Boleh Lebih Dari 15',
            'alamat_guru.required' => 'Alamat Wajib Diisi',
            'email_guru.required' => 'Email Wajib Diisi',
            'email_guru.email' => 'Email Tidak Valid',
            'email_guru.unique' => 'Email Sudah Ada',
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_guru' => 'nama_guru',
            'nip_guru' => 'NIP',
            'gender_guru' => 'jenis_kelamin',
            'tlp_guru' => 'no_telp',
            'alamat_guru' => 'alamat',
            'email_guru' => 'email'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        // Menampilkan SweetAlert ketika validasi gagal
        alert()->error('Gagal Update Data', 'Periksa Kembali Inputan Anda');

        throw new HttpResponseException(
            redirect()->back()->withErrors($validator)->withInput()
        );
    }
}
