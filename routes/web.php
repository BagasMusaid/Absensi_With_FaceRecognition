<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\master_data\KelasController;
use App\Http\Controllers\master_data\MapelController;
use App\Http\Controllers\master_data\WalikelasController;
use App\Http\Controllers\presensi\GuruController;
use App\Http\Controllers\presensi\SiswaController;
use App\Models\master_data\Walikelas;
use App\Models\presensi\Guru;
use App\Models\presensi\Siswa;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/dashbord', function () {
    $gurus = Guru::count();
    return view('dashbord', compact('gurus'));
})->middleware(['auth:guru,web', 'verified'])->name('dashbord');

Route::get('/presensi', function () {
    return view('pages.presensi');
})->name('presensi');

Route::controller(loginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    ROute::get('/logout', 'logout')->name('logout')->middleware('auth');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'create')->name('register')->middleware('guest');
    Route::post('/register', 'store');
});
Route::middleware(['auth:guru,web', 'verified'])->group(function () {
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
    Route::get('/walikelas/search', [WalikelasController::class, 'search'])->name('searchWalikelas');
    Route::resource('walikelas', WalikelasController::class);
});
