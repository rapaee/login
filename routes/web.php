<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RouteController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\RouteCompiler;

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
});

//raute view
Route::get('/role/admin/dashboardAdmin/',[RouteController::class,'dashboardAdmin'])->name('dashboardAdmin');
Route::get('/role/user/dashboardUser/',[RouteController::class,'dashboardUser'])->name('dashboardUser');

require __DIR__.'/auth.php';
