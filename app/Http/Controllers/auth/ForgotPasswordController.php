<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\presensi\Guru;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }
    function forgotPasswordEmail(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'email' => 'required|email',
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email harus berformat email',
        ]);
        if ($validasi->fails()) {
            return back()->withErrors($validasi)->withInput();
        }
        $isUser = User::where('email', $request->email)->exists();
        $isGuru = Guru::where('email', $request->email)->exists();
        if (!$isGuru && !$isUser) {
            return back()->withErrors(['email' => 'Email tidak terdaftar']);
        }
        $broker = $isGuru ? 'gurus' : 'users';
        $status = Password::broker($broker)->sendResetLink(
            $request->only('email')
        );
        if ($status === Password::RESET_LINK_SENT) {
            alert()->success('Success', 'Silahkan Check Email Anda Untuk Reset Password');
            return back()->with('success', __($status));
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }
    public function passwordReset(string $token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }
    public function resetPasswordUpdate(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ], [
            'token.required' => 'Token tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email harus berformat email',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sama',
        ]);
        if ($validasi->fails()) {
            return back()->withErrors($validasi)->withInput();
        }
        $isUser = User::where('email', $request->email)->exists();
        $isGuru = Guru::where('email', $request->email)->exists();

        if (!$isUser && !$isGuru) {
            return back()->withErrors(['email' => 'Email tidak terdaftar di sistem kami.']);
        }
        $broker = $isUser ? 'users' : 'gurus';

        $status = Password::broker($broker)->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === password::PASSWORD_RESET) {
            alert()->success('Success', 'Password Berhasil Diubah');
            return redirect()->route('login')->with('success', __($status));
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }
}
