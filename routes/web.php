<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('home');//, 'verified'
    
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');//, 'verified'
    
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user-status/{id}/{status}', [ProfileController::class, 'updateStatus'])->name('user.status.update');
    Route::get('/users', [ProfileController::class, 'users'])->name('users.list');
    Route::get('/user-edit/{id}', [ProfileController::class, 'editUser'])->name('user.edit');
    Route::post('/user-update', [ProfileController::class, 'UpdateUser'])->name('user.update');
    Route::post('/import-balance', [ImportController::class, 'importBalanceSheet'])->name('import.balance');
    Route::get('/import-balance-sheet', [ImportController::class, 'importBalanceSheetForm'])->name('import.balance.sheet');
    Route::post('/import-availed', [ImportController::class, 'importAvailedeSheet'])->name('import.availed');
    Route::get('/import-availed-sheet', [ImportController::class, 'importBalanceSheetForm'])->name('import.availed.sheet');
});

require __DIR__.'/auth.php';
