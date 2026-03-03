<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SystemRequestController;
use App\Http\Controllers\Api\SystemRequestApiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // مسارات عرض وإنشاء الطلبات
    Route::get('/requests', [SystemRequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/create', [SystemRequestController::class, 'create'])->name('requests.create');
    Route::post('/requests', [SystemRequestController::class, 'store'])->name('requests.store');

    // مسار تحديث الحالة (للمدير)
    Route::patch('/requests/{systemRequest}/status', [SystemRequestController::class, 'updateStatus'])->name('requests.update-status');
});

// مسار الـ API محمي بنفس نظام الدخول العادي (Basic & Clean)
Route::prefix('api')->middleware('auth')->group(function () {
    Route::get('/requests', [SystemRequestApiController::class, 'index']);
});

require __DIR__.'/auth.php';
