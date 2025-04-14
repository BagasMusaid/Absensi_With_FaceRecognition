<?php

use App\Http\Controllers\account\AkunController;
use App\Http\Controllers\auth\ForgotPasswordController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\VerificationController;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\laporan\LaporanGuruController;
use App\Http\Controllers\laporan\LaporanSiswaController;
use App\Http\Controllers\master_data\GuruPiketController;
use App\Http\Controllers\master_data\JadwalController;
use App\Http\Controllers\master_data\KelasController;
use App\Http\Controllers\master_data\MapelController;
use App\Http\Controllers\master_data\TahunAjaranController;
use App\Http\Controllers\master_data\WalikelasController;
use App\Http\Controllers\pengenalan\DaftarPresensiController;
use App\Http\Controllers\presensi\GuruController;
use App\Http\Controllers\presensi\PresensiController;
use App\Http\Controllers\presensi\PresensiSiswaController;
use App\Http\Controllers\presensi\SiswaController;
use App\Http\Middleware\EnsureUserHasAccess;
use App\Http\Middleware\EnsureUserIsGuru;
use App\Http\Middleware\EnsureUserIsWalikelas;
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
    ->middleware(['auth:web,wali,guru_piket,gurus', 'verified'])->name('dashbord');

Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('/forgot-password', 'index')->middleware('guest')->name('forgot');
    Route::post('forgot-password', 'forgotPasswordEmail')->name('password.email');
    Route::get('/reset-password/{token}', 'passwordReset')->name('password.reset');
    Route::post('/reset-password', 'resetPasswordUpdate')->name('password.update');
});
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout')->middleware('auth:web,wali,guru_piket,gurus');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'create')->name('register')->middleware('guest');
    Route::post('/register', 'store');
});
Route::middleware(['auth:web,gurus,wali'])->group(function () {
    Route::resource('guru', GuruController::class);
});
Route::middleware([EnsureUserIsGuru::class])->group(function () {
    Route::prefix('laporan-guru')->name('laporan-guru.')->controller(LaporanGuruController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/preview-guru', 'view_pdf')->name('viewGuru');
        Route::get('/download-guru', 'download_pdf')->name('downloadGuru');
        Route::get('/filter-guru', 'view_filter')->name('viewFilterGuru');
        Route::get('/download-excel-guru', 'export_excel')->name('download-excel');
    });
});

Route::middleware([EnsureUserIsGuru::class, EnsureUserIsWalikelas::class])->group(function () {
    Route::prefix('laporan-siswa')->name('laporan-siswa.')->controller(LaporanSiswaController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/preview-siswa', 'preview_pdf')->name('viewSiswa');
        Route::get('/download-siswa', 'download_pdf')->name('downloadSiswa');
        Route::get('/download-excel-siswa', 'export_excel_siswa')->name('excelSiswa');
        Route::get('/filter-siswa', 'filter')->name('filterSiswa');
    });
});

Route::middleware(['auth:web,wali,guru_piket,gurus', 'verified'])->group(function () {
    Route::get('/presensi', function () {
        return view('pages.presensi');
    })->name('presensi');
    Route::resource('siswa', SiswaController::class);
    Route::resource('mapel', MapelController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('guru-piket', GuruPiketController::class);
    Route::resource('tahun-ajaran', TahunAjaranController::class);
    Route::prefix('daftar-wajah')->name('daftar-wajah.')->controller(DaftarPresensiController::class)->group(function () {
        Route::get('/json', 'dataWajah')->name('data-wajah');
        Route::get('/{id}', 'index')->name('index');
        Route::post('/simpan-wajah', 'store')->name('simpan-wajah');
    });
    Route::prefix('presensi')->name('presensi.')->controller(PresensiController::class)->group(function () {
        Route::get('/', 'index')->name('presensi-siswa');
        Route::post('/proses', 'store')->name('simpan-presensi');
    });
    Route::resource('presensi-siswa', PresensiSiswaController::class);
    Route::get('/get-siswa-by-kelas/{kelasId}', [PresensiSiswaController::class, 'getSiswaByKelas']);
    Route::resource('walikelas', WalikelasController::class);
    Route::prefix('akun')->name('akun.')->controller(AkunController::class)->group(function () {
        Route::get('/', 'index');
        Route::patch('/update-profil', 'update_profil')->name('updateProfil');
        Route::patch('/update-data/{id}', 'update_data')->name('updateData');
    });
    Route::prefix('jadwal-kelas')->name('jadwal.')->controller(JadwalController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/detail/{id}', 'show_kelas')->name('detail');
    });
});
Route::get('/not-authorized', function () {
    return view('errors.unauthorized');
})->name('not-authorized');
