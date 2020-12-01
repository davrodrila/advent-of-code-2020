<?php

namespace App\day1;

use App\AbstractSolver;

class DayOneSolver extends AbstractSolver
{

    private const NUMBER_TO_ADD_TO = 2020;

    private const FIRST_NUMBER = 0;

    private const SECOND_NUMBER = 1;

    private const THIRD_NUMBER = 2;

    /** @var array $numbers */
    private array $numbers = [];

    public function solvePartOne(): string
    {
        $numbers = $this->buildArray();
        $entries = $this->findTwoEntriesAddingTo2020($numbers);
        return $entries[self::FIRST_NUMBER] * $entries[self::SECOND_NUMBER];
    }

    public function solvePartTwo(): string
    {
        $numbers = $this->buildArray();
        $entries = $this->findThreeEntriesAddingTo2020($numbers);

        return ($entries[self::FIRST_NUMBER] * $entries[self::SECOND_NUMBER] * $entries[self::THIRD_NUMBER]);
    }

    private function buildArray() {
        if (empty($this->numbers)) {
            foreach ($this->fileReader->readFile() as $line) {
                $this->numbers[$line] = '';
            }
        }

        return $this->numbers;
    }

    private function findTwoEntriesAddingTo2020(array $numbers): array
    {
        foreach ($numbers as $number => $value) {
            $firstNumber = static::NUMBER_TO_ADD_TO - $number;
            if (isset($numbers[$firstNumber])) {
                return [
                    static::FIRST_NUMBER => $number,
                    static::SECOND_NUMBER => $firstNumber
                ];
            }
        }
    }

    private function findThreeEntriesAddingTo2020(array $numbers): array
    {
        foreach ($numbers as $firstNumber => $value)
        {
            foreach ($numbers as $secondNumber => $secondValue) {
                if ($firstNumber !== $secondNumber) {
                    $thirdNumber = static::NUMBER_TO_ADD_TO - $firstNumber - $secondNumber;
                    if (isset($numbers[$thirdNumber])) {
                        return [
                            static::FIRST_NUMBER => $firstNumber,
                            static::SECOND_NUMBER => $secondNumber,
                            static::THIRD_NUMBER => $thirdNumber
                        ];
                    }
                }
            }
        }

        return [];
    }
}