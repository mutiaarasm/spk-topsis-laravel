<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataNasabahController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\PenilaianController;
use App\Http\Controllers\Admin\SubkriteriaController;
use App\Http\Controllers\Admin\TopsisController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Http\Request;
use App\Http\Controllers\LandingController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('dashboard', [DashboardController::class, 'indexPage'])->name('dashboard.index');
Route::get('dataNasabah', [DataNasabahController::class, 'indexPage'])->name('dataNasabah.index');
Route::get('login', [LoginController::class, 'loginpage'])->name('login');
Route::get('register', [RegisterController::class, 'registerpage'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('kriteria', [KriteriaController::class, 'indexPage'])->name('kriteria.index');
Route::get('dataNasabah/create', [DataNasabahController::class, 'create'])->name('dataNasabah.create');
Route::post('dataNasabah', [DataNasabahController::class, 'store'])->name('dataNasabah.store');

Route::get('dataNasabah/{id}/edit', [DataNasabahController::class, 'edit'])->name('dataNasabah.edit');
Route::put('dataNasabah/{id}', [DataNasabahController::class, 'update'])->name('dataNasabah.update');
Route::delete('dataNasabah/{id}', [DataNasabahController::class, 'destroy'])->name('dataNasabah.destroy');

Route::get('kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');
Route::post('kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
Route::get('kriteria/{id}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
Route::put('kriteria/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');
Route::delete('kriteria/{id}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');

Route::resource('kriteria.subKriteria', SubkriteriaController::class)->except(['show']);
Route::get('kriteria/{kriteria}/subkriteria', [SubkriteriaController::class, 'show'])->name('kriteria.show');
Route::post('kriteria/{kriteria}/subkriteria', [SubkriteriaController::class, 'store'])->name('subkriteria.store');

Route::prefix('kriteria/{kriteriaId}')->group(function () {
    Route::get('subkriteria/{subkriteriaId}/edit', [SubkriteriaController::class, 'edit'])->name('subkriteria.edit');
    Route::put('subkriteria/{subkriteriaId}', [SubkriteriaController::class, 'update'])->name('subkriteria.update');
});
Route::delete('kriteria/{kriteria}/subkriteria/{subkriteria}', [SubkriteriaController::class, 'destroy'])->name('subkriteria.destroy');

Route::get('penilaian', [PenilaianController::class, 'indexPage'])->name('penilaian.index');
Route::get('penilaian/create', [PenilaianController::class, 'create'])->name('penilaian.create');
Route::post('penilaian/store', [PenilaianController::class, 'store'])->name('penilaian.store');
Route::get('penilaian/{id}/edit', [PenilaianController::class, 'edit'])->name('penilaian.edit');
Route::put('penilaian/{id}', [PenilaianController::class, 'update'])->name('penilaian.update');
Route::delete('penilaian/{id}', [PenilaianController::class, 'destroy'])->name('penilaian.destroy');

Route::get('penilaian/topsis', [TopsisController::class, 'showTopsisPage'])->name('penilaian.topsis');

Route::get('landing', [LandingController::class, 'index'])->name('landing');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/home', function () {
    return redirect()->route('dashboard.index');
});

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');