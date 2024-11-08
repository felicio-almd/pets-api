<?php

use App\Http\Controllers\PetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/pets', [PetController::class, 'index']);
Route::post('/pets', [PetController::class, 'store']);
Route::get('/pet/{pet}', [PetController::class, 'show']);
Route::put('/pet/{pet}', [PetController::class, 'update']);
Route::delete('/pet/{pet}', [PetController::class, 'destroy']);
