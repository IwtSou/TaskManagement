<?php

use App\Http\Controllers\Admin\ApiUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')
    ->name('admin.')
    ->group(function() {
        Route::get('/getuser', [ApiUserController::class, 'getUsers'])->name('api');
    });
