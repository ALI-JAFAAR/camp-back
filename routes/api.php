<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GlobalController;
use App\Http\Controllers\ContentsController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\UsersController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('room'     , RoomController::class);
    Route::apiResource('content'     , ContentsController::class);
    Route::get('/GetComboBoxes', [GlobalController::class, 'GetComboBoxes']);

    Route::get('/contractors', [ContractorController::class, 'index']);
    Route::get('/contractors/{id}', [ContractorController::class, 'view']);
    Route::post('/contractors', [ContractorController::class, 'store']);
    Route::post('/logout', [UsersController::class, 'logout']);
    Route::get('/user', [UsersController::class, 'user']);
});

Route::post('/login', [UsersController::class, 'login']);
Route::post('/register', [UsersController::class, 'register']);
