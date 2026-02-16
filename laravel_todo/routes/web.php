<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route with parameter
Route::get('/hello/{name}', function ($name) {
    return "Hello, {$name}! Welcome to Laravel 12.";
});

// Route with optional parameter
Route::get('/greet/{name?}', function ($name = 'Guest') {
    return "Hello, {$name}!";
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $stats = [
            'total' => $user->todos()->count(),
            'completed' => $user->todos()->completed()->count(),
            'active' => $user->todos()->active()->count(),
            'high_priority' => $user->todos()->priority('high')->active()->count(),
        ];
        $recentTodos = $user->todos()->latest()->take(5)->get();
        
        return view('dashboard', compact('stats', 'recentTodos'));
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Todo routes
    Route::resource('todos', TodoController::class);
    Route::patch('/todos/{todo}/toggle', [TodoController::class, 'toggle'])->name('todos.toggle');
});

require __DIR__.'/auth.php';
