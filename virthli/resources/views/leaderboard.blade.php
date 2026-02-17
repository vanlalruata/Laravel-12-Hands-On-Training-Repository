@extends('layouts.app')

@section('title', 'Leaderboard')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-2xl p-8 mb-8">
            <h1 class="text-3xl font-bold mb-2">🏆 Sudoku Leaderboard</h1>
            <p class="opacity-90">Top players ranked by score</p>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
            <div class="flex gap-4">
                <a href="{{ route('leaderboard', ['difficulty' => 'all']) }}" 
                   class="px-4 py-2 rounded-lg {{ $difficulty === 'all' ? 'bg-yellow-500 text-white' : 'bg-gray-100' }}">
                    All
                </a>
                <a href="{{ route('leaderboard', ['difficulty' => 'easy']) }}"
                   class="px-4 py-2 rounded-lg {{ $difficulty === 'easy' ? 'bg-green-500 text-white' : 'bg-gray-100' }}">
                    Easy
                </a>
                <a href="{{ route('leaderboard', ['difficulty' => 'medium']) }}"
                   class="px-4 py-2 rounded-lg {{ $difficulty === 'medium' ? 'bg-yellow-500 text-white' : 'bg-gray-100' }}">
                    Medium
                </a>
                <a href="{{ route('leaderboard', ['difficulty' => 'hard']) }}"
                   class="px-4 py-2 rounded-lg {{ $difficulty === 'hard' ? 'bg-red-500 text-white' : 'bg-gray-100' }}">
                    Hard
                </a>
            </div>
        </div>

        <!-- Top 3 Podium -->
        @if($scores->count() >= 3)
        <div class="grid grid-cols-3 gap-4 mb-8">
            <!-- Second Place -->
            <div class="bg-gray-100 rounded-xl p-6 text-center order-1">
                <div class="text-4xl mb-2">🥈</div>
                <div class="text-xl font-bold text-gray-700">{{ $scores[1]->user->name ?? 'Player' }}</div>
                <div class="text-2xl font-bold text-gray-900">{{ $scores[1]->score_points }}</div>
                <div class="text-sm text-gray-500">points</div>
            </div>
            <!-- First Place -->
            <div class="bg-yellow-100 rounded-xl p-6 text-center order-2 -mt-4">
                <div class="text-5xl mb-2">👑</div>
                <div class="text-xl font-bold text-yellow-800">{{ $scores[0]->user->name ?? 'Player' }}</div>
                <div class="text-3xl font-bold text-yellow-700">{{ $scores[0]->score_points }}</div>
                <div class="text-sm text-yellow-600">points</div>
            </div>
            <!-- Third Place -->
            <div class="bg-orange-100 rounded-xl p-6 text-center order-3">
                <div class="text-4xl mb-2">🥉</div>
                <div class="text-xl font-bold text-orange-700">{{ $scores[2]->user->name ?? 'Player' }}</div>
                <div class="text-2xl font-bold text-orange-800">{{ $scores[2]->score_points }}</div>
                <div class="text-sm text-orange-600">points</div>
            </div>
        </div>
        @endif

        <!-- Full Leaderboard Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rank</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Player</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Score</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Difficulty</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($scores as $index => $score)
                    <tr class="{{ $index < 3 ? 'bg-yellow-50' : '' }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-lg font-bold {{ $index === 0 ? 'text-yellow-600' : ($index === 1 ? 'text-gray-500' : ($index === 2 ? 'text-orange-500' : 'text-gray-700')) }}">
                                #{{ $index + 1 }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $score->user->name ?? 'Anonymous' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm font-bold">
                                {{ $score->score_points }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                            {{ floor($score->time_seconds / 60) }}:{{ ($score->time_seconds % 60)->toString()->padStart(2, '0') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                {{ $score->difficulty === 'easy' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $score->difficulty === 'medium' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $score->difficulty === 'hard' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($score->difficulty) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection