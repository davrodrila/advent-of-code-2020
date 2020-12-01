<?php

namespace App;

use App\day1\DayOneSolver;
use App\File\FileReader;

class Bootstrap
{

    /**
     * @param array $argv
     *
     * @return AbstractSolver
     */
    public function obtainSolver(array $argv): AbstractSolver
    {
        if (isset($argv[1])) {
            $day = strtolower($argv[1]);
            if ($day === 'day1') {
                return new DayOneSolver(new FileReader("day1"));
            }
        } else {
            exit;
        }
    }
}