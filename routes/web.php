<?php

use App\Http\Controllers\MapController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('home'); });
Route::get('/map', [MapController::class, 'index']);

// Kelompok API
Route::get('/api/umkm', [MapController::class, 'getUmkm']);
Route::get('/api/jalan', [MapController::class, 'getJalan']);
Route::get('/api/simulasi', [MapController::class, 'getSimulasi']);
Route::get('/api/search-jalan', [MapController::class, 'searchJalan']); // Pastikan ada /api/