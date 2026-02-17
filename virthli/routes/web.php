<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ScoreController;
use Illuminate\Support\Facades\Route;

// Game routes
Route::post('/game/start', [GameController::class, 'start'])->name('game.start');
Route::post('/game/{game}/validate', [GameController::class, 'validate'])->name('game.validate');
Route::post('/game/{game}/complete', [GameController::class, 'complete'])->name('game.complete');
Route::get('/leaderboard', [ScoreController::class, 'index'])->name('leaderboard');

// Public routes
Route::get('/', function () {
    return view('sudoku');
});