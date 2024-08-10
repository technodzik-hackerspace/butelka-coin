<?php

use App\Http\Controllers\PrintController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/print', [PrintController::class, 'printPage'])->name('print');

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/add', [App\Http\Controllers\Barcode::class, 'add'])->name('add');
Route::post('/create', [App\Http\Controllers\Barcode::class, 'create'])->name('create');

Route::get('/check', [App\Http\Controllers\Refund::class, 'check'])->name('check');
