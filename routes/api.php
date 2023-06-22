<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rota para realizar login na aplicação (gera um token JWT)
Route::post('login', [AuthController::class, 'authenticate']);

// Grupo de rotas para os recursos de tasks protegido por autenticação JWT
Route::middleware('auth:api')->group(function () {
    Route::get('task', [TaskController::class, 'index']);
    Route::post('task', [TaskController::class, 'store']);
    Route::get('task/{id}', [TaskController::class, 'show']);
    Route::put('task/{id}', [TaskController::class, 'update']);
    Route::delete('task/{id}', [TaskController::class, 'destroy']);
});
