<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('puzzle'); // JSON encoded Sudoku puzzle
            $table->string('solution'); // JSON encoded solution
            $table->enum('difficulty', ['easy', 'medium', 'hard'])->default('easy');
            $table->enum('status', ['in_progress', 'completed', 'abandoned'])->default('in_progress');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};