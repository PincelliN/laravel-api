<?php

use App\Http\Controllers\Admin\DashController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\WorkController;
use App\Http\Controllers\Admin\TechnologyController;


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


Route::get('/', [PageController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashController::class, 'index'])->name('home');
        Route::get('work/trash', [WorkController::class, 'trash'])->name('work.trash');
        Route::patch('work/{id}/restore', [WorkController::class, 'restore'])->name('work.restore');
        Route::delete('work/{id}/delete', [WorkController::class, 'delete'])->name('work.delete');

        Route::resource('work', WorkController::class);
        Route::resource('type', TypeController::class)->except(['show', 'edit', 'create']);
        Route::resource('technology', TechnologyController::class)->except(['show', 'edit', 'create']);
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
