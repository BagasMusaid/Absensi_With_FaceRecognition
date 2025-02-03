<?php

namespace App\Http\Controllers\auth;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class VerificationController extends Controller
{
    public function show()
    {
        return view('auth.verify-email');
    }

    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        // Verifikasi bahwa hash yang diterima cocok dengan hash di database
        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            throw new \Illuminate\Auth\Access\AuthorizationException;
        }

        // Verifikasi tanggal jika diperlukan
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')->with('status', 'Email sudah diverifikasi.');
        }

        // Tandai email sebagai diverifikasi
        $user->markEmailAsVerified();

        // Redirect ke halaman yang sesuai setelah verifikasi
        alert()->success('Berhasil Register');
        return redirect()->route('login');
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        alert()->success('Berhasil Kirim Email Verifikasi', 'Silahkan Check Email Anda');
        return back();
    }
}
