#!/usr/bin/php
<?php



if (php_sapi_name() !== 'cli') {
    exit;
}

require __DIR__ . '/vendor/autoload.php';

use App\Bootstrap;

$app = new Bootstrap();
$result = $app->runCommand($argv);
echo $result;
