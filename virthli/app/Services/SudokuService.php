<?php

namespace App\Services;

class SudokuService
{
    private array $solution = [];
    private array $puzzle = [];

    public function generate(string $difficulty = 'easy'): array
    {
        // Generate a complete solved grid
        $this->solution = $this->generateSolution();
        
        // Create puzzle by removing numbers based on difficulty
        $this->puzzle = $this->createPuzzle($difficulty);
        
        return [
            'puzzle' => $this->puzzle,
            'solution' => $this->solution,
            'difficulty' => $difficulty,
        ];
    }

    private function generateSolution(): array
    {
        $grid = array_fill(0, 9, array_fill(0, 9, 0));
        $this->solve($grid);
        return $grid;
    }

    private function solve(array &$grid): bool
    {
        for ($row = 0; $row < 9; $row++) {
            for ($col = 0; $col < 9; $col++) {
                if ($grid[$row][$col] === 0) {
                    $numbers = shuffle([1,2,3,4,5,6,7,8,9]) ? [1,2,3,4,5,6,7,8,9] : range(1, 9);
                    foreach ($numbers as $num) {
                        if ($this->isValid($grid, $row, $col, $num)) {
                            $grid[$row][$col] = $num;
                            if ($this->solve($grid)) {
                                return true;
                            }
                            $grid[$row][$col] = 0;
                        }
                    }
                    return false;
                }
            }
        }
        return true;
    }

    private function isValid(array $grid, int $row, int $col, int $num): bool
    {
        // Check row
        for ($x = 0; $x < 9; $x++) {
            if ($grid[$row][$x] === $num) return false;
        }
        
        // Check column
        for ($x = 0; $x < 9; $x++) {
            if ($grid[$x][$col] === $num) return false;
        }
        
        // Check 3x3 box
        $boxRow = floor($row / 3) * 3;
        $boxCol = floor($col / 3) * 3;
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3; $j++) {
                if ($grid[$boxRow + $i][$boxCol + $j] === $num) return false;
            }
        }
        
        return true;
    }

    private function createPuzzle(string $difficulty): array
    {
        $puzzle = $this->solution;
        $cellsToRemove = match($difficulty) {
            'easy' => 35,
            'medium' => 45,
            'hard' => 55,
        };
        
        $positions = [];
        for ($i = 0; $i < 81; $i++) {
            $positions[] = [(int)($i / 9), $i % 9];
        }
        shuffle($positions);
        
        for ($i = 0; $i < $cellsToRemove && $i < count($positions); $i++) {
            [$row, $col] = $positions[$i];
            $puzzle[$row][$col] = 0;
        }
        
        return $puzzle;
    }

    public function validateMove(array $puzzle, int $row, int $col, int $value): bool
    {
        return $this->isValid($puzzle, $row, $col, $value);
    }
}