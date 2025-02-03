<?php

use App\Http\Controllers\account\AkunController;
use App\Http\Controllers\auth\ForgotPasswordController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\VerificationController;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\laporan\LaporanGuruController;
use App\Http\Controllers\laporan\LaporanSiswaController;
use App\Http\Controllers\master_data\KelasController;
use App\Http\Controllers\master_data\MapelController;
use App\Http\Controllers\master_data\WalikelasController;
use App\Http\Controllers\presensi\GuruController;
use App\Http\Controllers\presensi\SiswaController;
use Illuminate\Support\Facades\Route;

// Auth::routes(['verify' => true]);
Route::get('/', function () {
    return view('auth.login');
});
Route::prefix('email')->middleware('auth')->group(function () {
    Route::get('/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('/verification-notification', [VerificationController::class, 'resend'])->name('verification.send');
});

Route::get('/dashbord', [DashbordController::class, 'index'])
    ->middleware(['auth:web,wali', 'verified'])->name('dashbord');

Route::get('/presensi', function () {
    return view('pages.presensi');
})->name('presensi');
Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('/forgot-password', 'index')->middleware('guest')->name('forgot');
    Route::post('forgot-password', 'forgotPasswordEmail')->name('password.email');
    Route::get('/reset-password/{token}', 'passwordReset')->name('password.reset');
    Route::post('/reset-password', 'resetPasswordUpdate')->name('password.update');
});
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout')->middleware('auth');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'create')->name('register')->middleware('guest');
    Route::post('/register', 'store');
});
Route::middleware(['auth:web,wali', 'verified'])->group(function () {
    Route::resource('guru', GuruController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('mapel', MapelController::class);
    Route::resource('kelas', KelasController::class);
    Route::get('DaftarPresensi', function () {
        return view('pages.presensi.index');
    })->name('DaftarPresensi');
    Route::get('PresensiSiswa', function () {
        return view('pages.presensi.index');
    })->name('PresensiSiswa');
    Route::resource('walikelas', WalikelasController::class);
    Route::prefix('laporan-guru')->name('laporan-guru.')->controller(LaporanGuruController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/preview-guru', 'view_pdf')->name('viewGuru');
        Route::get('/download-guru', 'download_pdf')->name('downloadGuru');
        Route::get('/filter-guru', 'view_filter')->name('viewFilterGuru');
        Route::get('/download-excel-guru', 'export_excel')->name('download-excel');
    });
    Route::prefix('laporan-siswa')->name('laporan-siswa.')->controller(LaporanSiswaController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/preview-siswa', 'preview_pdf')->name('viewSiswa');
        Route::get('/download-siswa', 'download_pdf')->name('downloadSiswa');
        Route::get('/download-excel-siswa', 'export_excel_siswa')->name('excelSiswa');
        Route::get('/filter-siswa', 'filter')->name('filterSiswa');
    });
    Route::prefix('akun')->name('akun.')->controller(AkunController::class)->group(function () {
        Route::get('/', 'index');
    });
});
