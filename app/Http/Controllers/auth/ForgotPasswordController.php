<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\master_data\GuruPiket;
use App\Models\master_data\Walikelas;
use App\Models\presensi\Guru;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

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
            'guard' => 'required|in:gurus,wali,guru_piket',
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email harus berformat email',
            'guard.required' => 'Silahkan pilih jenis akun',
        ]);
        if ($validasi->fails()) {
            return back()->withErrors($validasi)->withInput();
        }

        $email = $request->email;
        $selectedGuard = $request->guard;

        $guru = Guru::where('email', $email)->first();

        if (!$guru) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        // Validasi peran berdasarkan guard yang dipilih
        if ($selectedGuard === 'wali' && !$guru->walikelas) {
            return back()->withErrors(['guard' => 'Email ini tidak terdaftar sebagai Wali Kelas.']);
        }

        if ($selectedGuard === 'guru_piket' && !$guru->piket) {
            return back()->withErrors(['guard' => 'Email ini tidak terdaftar sebagai Guru Piket.']);
        }

        // Gunakan broker 'guru' karena hanya model Guru yang punya email
        $status = Password::broker('guru')->sendResetLink(['email' => $email]);

        if ($status === Password::RESET_LINK_SENT) {
            alert()->success('Berhasil', 'Silakan periksa email Anda untuk mereset password.');
            return back()->with('success', __($status));
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }
    public function passwordReset(string $token)
    {
        return view('auth.reset-password', [
            'token' => $token
        ]);
    }
    public function resetPasswordUpdate(Request $request)
    {

        $validasi = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'guard' => 'required|in:gurus,wali,guru_piket',
        ], [
            'token.required' => 'Token tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email harus berformat email',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sama',
            'guard.required' => 'Jenis akun wajib dipilih',
        ]);
        if ($validasi->fails()) {
            return back()->withErrors($validasi)->withInput();
        }

        $guard = $request->guard;
        $email = $request->email;
        // Gunakan broker 'guru' karena token disimpan berdasarkan model Guru
        $status = Password::broker('guru')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($foundUser, $password) use ($guard) {
                switch ($guard) {
                    case 'wali':
                        $modelToUpdate = $foundUser->walikelas()->first();
                        break;

                    case 'guru_piket':
                        $modelToUpdate = $foundUser->piket()->first();
                        break;

                    case 'gurus':
                    default:
                        $modelToUpdate = $foundUser;
                        break;
                }

                // Jika model relasi tidak ditemukan
                if (!$modelToUpdate) {
                    throw ValidationException::withMessages([
                        'email' => ['Data pengguna tidak ditemukan untuk jenis akun ini.'],
                    ]);
                }

                $modelToUpdate->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $modelToUpdate->save();

                event(new PasswordReset($modelToUpdate));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            alert()->success('Sukses', 'Password berhasil diperbarui.');
            return redirect()->route('login')->with('success', __($status));
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }
}
