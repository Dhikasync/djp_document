<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DocumentController;

Route::get('/', function () {
    return view('Dashboard.halaman_utama');
});

Route::get('/upload', function () {
    return view('upload.upload');
});

Route::post('/upload', [DocumentController::class, 'upload'])->name('document.upload');
Route::post('/download', [DocumentController::class, 'download'])->name('document.download');
Route::post('/clear', [DocumentController::class, 'clear'])->name('document.clear');
