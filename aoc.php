#!/usr/bin/php
<?php



if (php_sapi_name() !== 'cli') {
    exit;
}

require __DIR__ . '/vendor/autoload.php';

use App\Bootstrap;

$app = new Bootstrap();
$solver = $app->obtainSolver($argv);

echo "Los datos del primer resultado son: " . $solver->solvePartOne() . PHP_EOL;

echo "Los datos del segundo resultado son: " . $solver->solvePartTwo() . PHP_EOL;
