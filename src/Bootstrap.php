<?php

namespace App;

use App\day1\DayOneSolver;
use App\File\FileReader;

class Bootstrap
{

    /**
     * @param array $argv
     *
     * @return string
     */
    public function runCommand(array $argv): string
    {
        if (isset($argv[1])) {
            $day = strtolower($argv[1]);
            if ($day === 'day1') {
                $solver = new DayOneSolver(new FileReader("day1"));
                return $solver->solve();
            }
        } else {
            exit;
        }
    }
}