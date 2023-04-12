<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController; //importo i controller ma do un nome personalizzato altrimenti sarebbero uguali
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Guest\HomeController as GuestHomeController;

use Illuminate\Support\Facades\Route;

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

Route::get('/', [GuestHomeController::class, 'index']); //rotte statiche

Route::get('/home', [AdminHomeController::class, 'index'])->middleware('auth')->name('home'); //verifica una rotta singola


Route::middleware('auth')->prefix('/admin')->name('admin.')->group(function () {
    Route::resource('projects', ProjectController::class)->parameters(['projects' => 'project:slug']);
});


Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () { // quando c'è il group ne verifica più di una
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});

require __DIR__ . '/auth.php'; //serve a dividere le rotte dell'autentificazione auth

//prefix() metto un prefisso comune alle rotte
//posso utilizzare un suffisso anche per il name()