<?php

namespace App\Providers;

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
            return auth()->guard('gurus')->check() && $user?->kepalasekolah == 'ya';
        });
        Gate::define('akses-dashbord', function ($user) {
            return auth()->guard('wali')->check()
                || auth()->guard('guru_piket')->check();
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
                || auth()->guard('wali')->check();
        });
        Gate::define('akses-presensi', function ($user) {
            return auth()->guard('guru_piket')->check()
                || auth()->guard('wali')->check();
        });
    }
}
