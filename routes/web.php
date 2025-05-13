<?php

use App\Http\Controllers\account\AkunController;
use App\Http\Controllers\auth\ForgotPasswordController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\VerificationController;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\laporan\LaporanGuruController;
use App\Http\Controllers\laporan\LaporanMapelController;
use App\Http\Controllers\laporan\LaporanPresensiController;
use App\Http\Controllers\laporan\LaporanSiswaController;
use App\Http\Controllers\laporan\RangkingController;
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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
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
    Route::get('/siswa/filter-by-kelas/{kelasId}', [SiswaController::class, 'filterByKelas']);
    Route::prefix('ranking-kehadiran')->name('ranking.')->controller(RangkingController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/get-ranking-presensi', 'getRanking')->name('kehadiran.filter');
    });
});
Route::middleware(['auth:web'])->group(function () {
    Route::resource('kelas', KelasController::class);
    Route::resource('tahun-ajaran', TahunAjaranController::class);
    Route::resource('walikelas', WalikelasController::class);
});

// Route::middleware([EnsureUserIsGuru::class, EnsureUserIsWalikelas::class])->group(function () {});
Route::middleware(['auth:gurus,wali,web', 'verified'])->group(function () {
    Route::prefix('laporan-siswa')->name('laporan-siswa.')->controller(LaporanSiswaController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/preview-siswa', 'preview_pdf')->name('viewSiswa');
        Route::get('/download-siswa', 'download_pdf')->name('downloadSiswa');
        Route::get('/download-excel-siswa', 'export_excel_siswa')->name('excelSiswa');
        Route::get('/filter-siswa', 'filter')->name('filterSiswa');
    });
    Route::prefix('laporan-presensi')->name('laporan-presensi.')->controller(LaporanPresensiController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/preview-presensi', 'view_pdf')->name('viewPresensi');
        Route::get('/download-presensi', 'download_pdf')->name('downloadPresensi');
        Route::get('/download-excel-presensi', 'export_excel_presensi')->name('excelPresensi');
        Route::get('/filter-presensi', 'view_filter')->name('filterPresensi');
    });
    Route::prefix('laporan-mata-pelajaran')->name('laporan-mata-pelajaran.')->controller(LaporanMapelController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/preview-mapel', 'view_pdf')->name('viewMapel');
        Route::get('/download-mapel', 'download_pdf')->name('downloadMapel');
        Route::get('/download-excel-mapel', 'export_excel_mapel')->name('excelMapel');
        Route::get('/filter-mapel', 'view_filter')->name('filterMapel');
    });
});

Route::middleware(['auth:gurus,web', 'verified'])->group(function () {
    Route::prefix('laporan-guru')->name('laporan-guru.')->controller(LaporanGuruController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/preview-guru', 'view_pdf')->name('viewGuru');
        Route::get('/download-guru', 'download_pdf')->name('downloadGuru');
        Route::get('/filter-guru', 'view_filter')->name('viewFilterGuru');
        Route::get('/download-excel-guru', 'export_excel')->name('download-excel');
    });
});
Route::middleware(['auth:wali', 'verified'])->group(function () {
    Route::prefix('daftar-wajah')->name('daftar-wajah.')->controller(DaftarPresensiController::class)->group(function () {
        Route::get('/json', 'dataWajah')->name('data-wajah');
        Route::get('/train-model', 'trainModel')->name('train');
        Route::post('/simpan-wajah', 'store')->name('simpan-wajah');
        Route::get('/{id}', 'index')->name('index');
    });
});
Route::middleware(['auth:wali,guru_piket', 'verified'])->group(function () {
    Route::prefix('presensi')->name('presensi.')->controller(PresensiController::class)->group(function () {
        Route::get('/{kelasId}', 'index')->name('presensi-wajah');
        Route::post('/proses', 'store')->name('simpan-presensi');
    });
    Route::resource('presensi-siswa', PresensiSiswaController::class);
    Route::get('/presensi/kelas/{jadwalId}/data', [PresensiController::class, 'getPresensiByJadwal']);
    Route::get('/get-siswa-by-kelas/{kelasId}', [PresensiSiswaController::class, 'getSiswaByKelas']);
    Route::get('/status-presensi', [PresensiSiswaController::class, 'status_presensi'])->name('StatusPresensi');
    Route::get('/presensi/filter-by-kelas/{kelasId}', [PresensiSiswaController::class, 'filterByKelas']);
    Route::post('/jadwal-presensi', [DashbordController::class, 'store_jadwal'])->name('jadwal-presensi');
});
Route::middleware(['auth:web,guru_piket,wali', 'verified'])->group(function () {
    Route::resource('guru-piket', GuruPiketController::class);
    Route::resource('siswa', SiswaController::class);
});
Route::middleware(['auth:web,wali,guru_piket,gurus', 'verified'])->group(function () {
    Route::resource('mapel', MapelController::class);
    Route::prefix('akun')->name('akun.')->controller(AkunController::class)->group(function () {
        Route::get('/', 'index');
        Route::patch('/update-profil', 'update_profil')->name('updateProfil');
        Route::patch('/update-data/{id}', 'update_data')->name('updateData');
        Route::delete('/delete-foto-profil', 'delete_profil')->name('deleteProfil');
    });
    Route::prefix('jadwal-kelas')->name('jadwal.')->controller(JadwalController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/detail/{id}', 'show_kelas')->name('detail');
    });
});
Route::get('/get-model', function () {
    $modelPath = base_path('face_training/face_model.h5'); // Menyesuaikan path model
    if (file_exists($modelPath)) {
        return Response::download($modelPath);
    } else {
        return response()->json(['error' => 'Model file not found'], 404);
    }
});

Route::get('/get-label-encoder', function () {
    $labelEncoderPath = base_path('face_training/label_encoder.json'); // Menyesuaikan path label encoder
    if (file_exists($labelEncoderPath)) {
        return Response::download($labelEncoderPath);
    } else {
        return response()->json(['error' => 'Label encoder file not found'], 404);
    }
});
Route::get('/not-authorized', function () {
    return view('errors.unauthorized');
})->name('not-authorized');
