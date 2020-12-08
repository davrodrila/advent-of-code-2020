<?php

namespace App;

use App\day1\DayOneSolver;
use App\day2\DayTwoSolver;
use App\day3\DayThreeSolver;
use App\day4\DayFourSolver;
use App\day5\DayFiveSolver;
use App\day6\DaySixSolver;
use App\day7\DaySevenSolver;
use App\day8\DayEightSolver;
use App\File\FileReader;

class Bootstrap
{
    private const PARAM_TO_CLASS = [
        'day1' => DayOneSolver::class,
        'day2' => DayTwoSolver::class,
        'day3' => DayThreeSolver::class,
        'day4' => DayFourSolver::class,
        'day5' => DayFiveSolver::class,
        'day6' => DaySixSolver::class,
        'day7' => DaySevenSolver::class,
        'day8' => DayEightSolver::class,
    ];

    /**
     * @param array $argv
     *
     * @return AbstractSolver|null
     */
    public function obtainSolver(array $argv): ?AbstractSolver
    {
        if (isset($argv[1])) {
            $requestedSolver = strtolower($argv[1]);
            if (isset(static::PARAM_TO_CLASS[$requestedSolver])) {
                $solverClass = static::PARAM_TO_CLASS[$requestedSolver];
                return new $solverClass(new FileReader($requestedSolver));
            }
        }

        return null;
    }
}