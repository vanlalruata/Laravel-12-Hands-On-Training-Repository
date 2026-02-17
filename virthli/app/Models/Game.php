<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['puzzle', 'solution', 'difficulty', 'status', 'user_id'];

    protected $casts = [
        'puzzle' => 'array',
        'solution' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scores(): HasMany
    {
        return $this->hasMany(Score::class);
    }

    public function calculateScore(int $timeSeconds, int $mistakes, int $hints): int
    {
        $baseScore = match($this->difficulty) {
            'easy' => 100,
            'medium' => 200,
            'hard' => 300,
        };

        // Time bonus (faster = more points)
        $timeBonus = max(0, 1000 - $timeSeconds);
        
        // Penalty for mistakes and hints
        $penalty = ($mistakes * 10) + ($hints * 20);

        return max(0, $baseScore + $timeBonus - $penalty);
    }
}