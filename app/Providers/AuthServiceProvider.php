<?php

namespace App\Providers;

use App\Models\presensi\Guru;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }
    protected $policies = [];
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        // Definisikan hak akses berdasarkan guard
        Gate::define('akses-admin', function ($user) {
            return auth()->guard('web')->check();
        });

        Gate::define('akses-wali', function ($user) {
            return auth()->guard('wali')->check();
        });

        Gate::define('akses-guru_piket', function ($user) {
            return auth()->guard('guru_piket')->check()
                || auth()->guard('web')->check()
                || auth()->guard('wali')->check();
        });

        Gate::define('akses-kepala_sekolah', function ($user) {
            return auth()->guard('gurus')->check() && $user?->kepalasekolah == 'ya'
                || auth()->guard('web')->check();
        });
        Gate::define('akses-dashbord', function ($user) {
            $hariIni = Carbon::now()->isoFormat('dddd'); // contoh: 'Senin', 'Selasa', dst.
            // Jika guard wali, izinkan
            if (Auth::guard('wali')->check()) {
                return true;
            }
            // Jika guard guru_piket, cek harinya
            if (Auth::guard('guru_piket')->check()) {
                $guru = $user;
                return strtolower($guru->hari) === strtolower($hariIni);
            }
            return false;
        });
        Gate::define('akses-siswa', function ($user) {
            return auth()->guard('wali')->check()
                || auth()->guard('web')->check()
                || auth()->guard('guru_piket')->check();
        });
        Gate::define('akses-guru', function ($user) {
            return (auth()->guard('web')->check() || auth()->guard('wali')->check()) || auth()->guard('gurus')->check() && $user?->kepalasekolah == 'ya';
        });
        Gate::define('akses-jadwal_mapel', function ($user) {
            return auth()->guard('gurus')->check() && $user?->kepalasekolah == 'ya'
                || auth()->guard('guru_piket')->check()
                || auth()->guard('wali')->check();
        });
        Gate::define('akses-mapel', function ($user) {
            return auth()->guard('gurus')->check() && $user?->kepalasekolah == 'ya'
                || auth()->guard('wali')->check()
                || auth()->guard('guru_piket')->check();
        });
        Gate::define('akses-guru_piket', function ($user) {
            return auth()->guard('web')->check()
                || auth()->guard('wali')->check();
        });
        Gate::define('akses-laporan', function ($user) {
            return (auth()->guard('gurus')->check() && $user->kepalasekolah == 'ya')
                || auth()->guard('wali')->check()
                || auth()->guard('web')->check();
        });
        Gate::define('akses-presensi', function ($user) {
            return auth()->guard('guru_piket')->check()
                || auth()->guard('wali')->check();
        });
        Gate::define('akses-ranking', function ($user) {
            return auth()->guard('gurus')->check() && $user?->kepalasekolah == 'ya'
                || auth()->guard('wali')->check()
                || auth()->guard('web')->check();
        });
    }
}
