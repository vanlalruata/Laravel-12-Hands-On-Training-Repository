<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{
    public function index(Request $request)
    {
        $difficulty = $request->input('difficulty', 'all');
        
        $query = Score::with('user')
            ->select('scores.*', DB::raw('ROW_NUMBER() OVER (ORDER BY score_points DESC) as rank'))
            ->orderByDesc('score_points');

        if ($difficulty !== 'all') {
            $query->where('difficulty', $difficulty);
        }

        $scores = $query->limit(100)->get();

        // Get user stats if authenticated
        $userStats = null;
        if (Auth::check()) {
            $userStats = Score::where('user_id', Auth::id())
                ->when($difficulty !== 'all', fn($q) => $q->where('difficulty', $difficulty))
                ->selectRaw('COUNT(*) as games_played')
                ->selectRaw('AVG(score_points) as avg_score')
                ->selectRaw('MAX(score_points) as best_score')
                ->first();
        }

        return view('leaderboard', compact('scores', 'userStats', 'difficulty'));
    }

    public function userStats()
    {
        $stats = [
            'total_games' => Score::where('user_id', auth()->id())->count(),
            'total_score' => Score::where('user_id', auth()->id())->sum('score_points'),
            'best_score' => Score::where('user_id', auth()->id())->max('score_points'),
            'avg_time' => Score::where('user_id', auth()->id())->avg('time_seconds'),
        ];

        return response()->json($stats);
    }
}