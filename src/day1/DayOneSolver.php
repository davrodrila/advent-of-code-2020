<?php

namespace App\day1;

use App\AbstractSolver;

class DayOneSolver extends AbstractSolver
{

    private const NUMBER_TO_ADD_TO = 2020;

    private const FIRST_NUMBER = 0;

    private const SECOND_NUMBER = 1;

    public function solve(): string
    {
        $numbers = $this->buildArray();
        $entries = $this->findEntriesAddingTo2020($numbers);
        return $entries[self::FIRST_NUMBER] * $entries[self::SECOND_NUMBER];
    }

    private function buildArray() {
        $numbers = [];
        foreach ($this->fileReader->readFile() as $line) {
            $numbers[$line] = '';
        }

        return $numbers;
    }

    private function findEntriesAddingTo2020(array $numbers): array
    {
        foreach ($numbers as $number => $value) {
            $left = static::NUMBER_TO_ADD_TO - $number;
            if (isset($numbers[$left])) {
                return [
                    static::FIRST_NUMBER => $number,
                    static::SECOND_NUMBER => $left
                ];
            }
        }
    }
}