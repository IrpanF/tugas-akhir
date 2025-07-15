<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChartController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Mengarahkan root ("/") langsung ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/data-historis', function () {
    return view('data-historis');
})->middleware(['auth'])->name('data-historis');

Route::get('/prediksi-harga', function () {
    return view('prediksi-harga');
})->middleware(['auth'])->name('prediksi-harga');

Route::get('/indikator-teknikal', function () {
    return view('indikator-teknikal');
})->middleware(['auth'])->name('indikator-teknikal');

Route::get('/analisis-ekonomi', function () {
    return view('analisis-ekonomi');
})->middleware(['auth'])->name('analisis-ekonomi');

Route::get('/manajemen-data', function () {
    return view('manajemen-data');
})->middleware(['auth'])->name('manajemen-data');

Route::get('/pengaturan-model', function () {
    return view('pengaturan-model');
})->middleware(['auth'])->name('pengaturan-model');

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/coba', function () {
    return view('coba');
})->middleware(['auth'])->name('coba');

Route::get('/chart-data', [ChartController::class, 'getChartData'])->middleware(['auth'])->name('chart-data');