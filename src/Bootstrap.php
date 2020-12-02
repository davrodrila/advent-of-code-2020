<?php

namespace App;

use App\day1\DayOneSolver;
use App\day2\DayTwoSolver;
use App\File\FileReader;

class Bootstrap
{

    /**
     * @param array $argv
     *
     * @return AbstractSolver|null
     */
    public function obtainSolver(array $argv): ?AbstractSolver
    {
        if (isset($argv[1])) {
            $day = strtolower($argv[1]);
            if ($day === 'day1') {
                return new DayOneSolver(new FileReader("day1"));
            } elseif ($day === 'day2') {
                return new DayTwoSolver(new FileReader("day2"));
            }
        } else {
            exit;
        }

        return null;
    }
}