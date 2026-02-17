<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Score;
use App\Services\SudokuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function __construct(private SudokuService $sudoku)
    {
    }

    public function start(Request $request)
    {
        $difficulty = $request->input('difficulty', 'easy');
        
        $gameData = $this->sudoku->generate($difficulty);
        
        $game = Game::create([
            'puzzle' => $gameData['puzzle'],
            'solution' => $gameData['solution'],
            'difficulty' => $difficulty,
            'status' => 'in_progress',
            'user_id' => Auth::id(), // Will be null for guests
        ]);

        return response()->json([
            'game_id' => $game->id,
            'puzzle' => $game->puzzle,
            'difficulty' => $game->difficulty,
        ]);
    }

    public function validate(Request $request, Game $game)
    {
        $row = $request->input('row');
        $col = $request->input('col');
        $value = $request->input('value');
        
        $isValid = $this->sudoku->validateMove(
            $game->puzzle, 
            $row, 
            $col, 
            $value
        );

        // Update puzzle with the new value if valid
        if ($isValid) {
            $puzzle = $game->puzzle;
            $puzzle[$row][$col] = $value;
            $game->update(['puzzle' => $puzzle]);
            
            // Check if puzzle is complete
            $isComplete = $this->isComplete($puzzle, $game->solution);
            
            if ($isComplete) {
                $game->update(['status' => 'completed']);
            }
        }

        return response()->json([
            'valid' => $isValid,
            'is_complete' => $isComplete ?? false,
        ]);
    }

    public function complete(Request $request, Game $game)
    {
        $score = $game->calculateScore(
            $request->input('time_seconds'),
            $request->input('mistakes', 0),
            $request->input('hints_used', 0)
        );

        if (Auth::check()) {
            Score::create([
                'user_id' => Auth::id(),
                'game_id' => $game->id,
                'time_seconds' => $request->input('time_seconds'),
                'mistakes' => $request->input('mistakes', 0),
                'hints_used' => $request->input('hints_used', 0),
                'difficulty' => $game->difficulty,
                'score_points' => $score,
                'completed_at' => now(),
            ]);
        }

        $game->update(['status' => 'completed']);

        return response()->json([
            'score' => $score,
            'message' => 'Congratulations! Game completed!',
        ]);
    }

    private function isComplete(array $puzzle, array $solution): bool
    {
        for ($i = 0; $i < 9; $i++) {
            for ($j = 0; $j < 9; $j++) {
                if ($puzzle[$i][$j] !== $solution[$i][$j]) {
                    return false;
                }
            }
        }
        return true;
    }
}