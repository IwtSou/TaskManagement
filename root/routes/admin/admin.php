<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware('auth:admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function() {
        Route::prefix('tasks')->name('tasks.')->controller(TaskController::class)->group(function() {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::put('update/{task}', 'update')->name('update');
            Route::delete('destroy/{task}', 'destroy')->name('destroy');
        });
        Route::prefix('user')
            ->name('users.')
            ->controller(UserController::class)
            ->group(function() {
                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::put('update/{user}', 'update')->name('update');
            Route::delete('destroy/{user}', 'destroy')->name('destroy');

            });
    });


Route::middleware('auth:admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

require __DIR__.'/auth.php';
