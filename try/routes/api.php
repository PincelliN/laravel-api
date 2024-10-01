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

Route::get('/works', [PageController::class, 'AllWorks']);
Route::get('/types', [PageController::class, 'AllTypes']);
Route::get('/technologis', [PageController::class, 'AllTechnologies']);
Route::get('/dettaglio/{slug}', [PageController::class, 'DetailWork']);
Route::get('/Tutti-i-progetti-per-tipo/{slug}', [PageController::class, 'TypeAllWorks']);
Route::get('/Tutti-i progetti-per-Tecnologie/{slug}', [PageController::class, 'TechnologyWorks']);
