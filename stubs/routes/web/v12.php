<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login', [\Ogilo\AdminMd\Http\Controllers\AuthController::class, 'getLogin'])->name('login');