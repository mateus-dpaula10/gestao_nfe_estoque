<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\ProdutoOutputController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function() {
    Route::resource('produtos', ProdutoController::class);
    Route::resource('notas', NotaController::class);
    Route::resource('nfsaida', ProdutoOutputController::class);
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
});

Auth::routes();
Auth::routes(['reset' => true]);
