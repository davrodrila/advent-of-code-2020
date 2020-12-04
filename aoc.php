#!/usr/bin/php
<?php



if (php_sapi_name() !== 'cli') {
    exit;
}

require __DIR__ . '/vendor/autoload.php';

use App\Bootstrap;

$app = new Bootstrap();
$solver = $app->obtainSolver($argv);
if ($solver) {
    echo "First part data: " . $solver->solvePartOne() . PHP_EOL;
    echo "Second part data: " . $solver->solvePartTwo() . PHP_EOL;
} else {
    echo "Provided day not found! Perhaps I haven't gotten around doing that day yet, or maybe you are not writing it correctly! Remember to use numbers for the day e.g: day1, day2, etc..." . PHP_EOL;
}