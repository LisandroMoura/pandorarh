<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\FuncionarioController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});

/// rota para funcionários Entity
//Route::middleware('auth:sanctum')->group(function () {
Route::apiResource("funcionarios", FuncionarioController::class);
//});
// rota para cargos Entity
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource("cargos", CargoController::class);
});
