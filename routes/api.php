<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampeonatoController;
use App\Http\Controllers\FlamengoController;
use App\Http\Controllers\FlorminencController;

Route::get('/', function(){
    return response()->json(['sucesso' => true]);
});

// CAMPEONATO
Route::get('/camp', [CampeonatoController::class, 'index']);
Route::post('/camp', [CampeonatoController::class, 'store']);
Route::delete('/camp/{id}', [CampeonatoController::class, 'destroy']);
Route::put('/camp/{id}', [CampeonatoController::class, 'update']);
Route::get('/camp/{id}', [CampeonatoController::class, 'show']);

// FLAMENGO
Route::get('/fla', [FlamengoController::class, 'index']);
Route::post('/fla', [FlamengoController::class, 'store']);
Route::delete('/fla/{id}', [FlamengoController::class, 'destroy']);
Route::put('/fla/{id}', [FlamengoController::class, 'update']);
Route::get('/fla/{id}', [FlamengoController::class, 'show']);

// FLORMINENC
Route::get('/flu', [FlorminencController::class, 'index']);
Route::post('/flu', [FlorminencController::class, 'store']);
Route::delete('/flu/{id}', [FlorminencController::class, 'destroy']);
Route::put('/flu/{id}', [FlorminencController::class, 'update']);
Route::get('/flu/{id}', [FlorminencController::class, 'show']);

// MOSTRAR OS CLUBES PARTICIPANTES
Route::get('/camp/{id}/clubes', [CampeonatoController::class, 'getClubes']);
