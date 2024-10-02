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

Route::get('/works', [PageController::class, 'allWorks']);
Route::get('/types', [PageController::class, 'allTypes']);
Route::get('/technologies', [PageController::class, 'allTechnologies']);
Route::get('/dettaglio/{slug}', [PageController::class, 'detailWork']);
Route::get('/Tutti-i-progetti-per-tipo/{slug}', [PageController::class, 'typeAllWorks']);
Route::get('/Tutti-i progetti-per-Tecnologie/{slug}', [PageController::class, 'technologyWorks']);
