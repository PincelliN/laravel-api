<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/tutti-i-progetti', [PageController::class, 'AllWorks']);
Route::get('/tutti-i-tipi', [PageController::class, 'AllTypes']);
Route::get('/tutte-le_tecnologie', [PageController::class, 'AllTechnologies']);
Route::get('/dettaglio/{slug}', [PageController::class, 'DetailWork']);
Route::get('/Tutti-i-progetti-per-tipo/{slug}', [PageController::class, 'TypeAllWorks']);
Route::get('/Tutti-i progetti-per-Tecnologie/{slug}', [PageController::class, 'TechnologyWorks']);
