<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('/settings', [AdminController::class, 'adminSettings'])->name('admin.settings');
    // Route::post('/settings', [AdminController::class, 'updateAdminSettings'])->name('admin.update');
    Route::get('/users', [AdminController::class, 'getUsers'])->name('admin.users');
    Route::get('/users/edit/{id}', [AdminController::class, 'getEditUser'])->name('admin.edit');
    Route::post('/users/edit/{id}', [AdminController::class, 'updateUserData'])->name('admin.update');
    Route::post('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.destroy');
    Route::get('/create', [AdminController::class, 'addNewUser'])->name('admin.create');
    Route::post('/create', [AdminController::class, 'createNewUser'])->name('admin.new');
    Route::post('/users/block/{id}', [AdminController::class, 'isUserBlock'])->name('admin.block');
});
