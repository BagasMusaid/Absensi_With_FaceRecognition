<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    public function create()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => "required|max:225",
            'username' => "required|max:225|unique:users",
            'email' => "required|email:dns|max:225",
            'password' => "required|min:8|max:225|alpha_dash",
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.max' => 'Nama tidak boleh lebih dari 225 karakter',
            'username.required' => 'Username tidak boleh kosong',
            'username.max' => 'Username tidak boleh lebih dari 225 karakter',
            'username.unique' => 'Username sudah digunakan, pilih username lain',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.max' => 'Email tidak boleh lebih dari 225 karakter',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password harus lebih dari 8 karakter',
            'password.alpha_dash' => 'Password hanya boleh mengandung huruf dan angka'

        ]);
        $user = User::create([
            'name' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);
        event(new Registered($user));
        Auth::login($user);
        return redirect()->route('login');
    }
}
