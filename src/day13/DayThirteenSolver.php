<?php


namespace App\day13;


use App\AbstractSolver;
use App\File\FileReader;

class DayThirteenSolver extends AbstractSolver
{

    private array $rawData;


    public function __construct(FileReader $fileReader)
    {
        parent::__construct($fileReader);
        $this->rawData = $this->fileToArrayAsValue();
    }


    public function solvePartOne(): string
    {

        $timeStampICanLeaveAt = $this->rawData[0];
        $possibleTimes = array_map(function ($value) {
            return intval($value);
        }, preg_split('/,/', str_replace('x,', '', $this->rawData[1])));

        $minimalTimes = [1, PHP_INT_MAX];
        foreach ($possibleTimes as $possibleTime) {
            $maxTimeToLeave = 0;
            $multiplier = 1;
            while ($maxTimeToLeave < $timeStampICanLeaveAt) {
                $maxTimeToLeave = $possibleTime * $multiplier;
                $multiplier++;
            }
            $earliestPickupTime = ($maxTimeToLeave - $timeStampICanLeaveAt);
            if ($minimalTimes[1] > $earliestPickupTime) {
                $minimalTimes = [$possibleTime, $earliestPickupTime];
            }
        }
        return ( $minimalTimes[1] * $minimalTimes[0]);
    }

    public function solvePartTwo(): string
    {
        $busTable = preg_split('/,/',  $this->rawData[1]);
        $wolphram = 'http://www.wolframalpha.com/input?i=solve';
        foreach ($busTable as $busOffset => $value) {
            var_dump($busOffset);
            if ($value !== "x") {
                $wolphram .= sprintf("(t + %s) mod %s", $busOffset, $value);
            }
        }
        return sprintf("Use this link to get the answer. Look at Chinese Remainder Theory. Output 2big4php %s", $wolphram);
    }
}