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

    /**
     * @return string
     */
    public function solvePartOne(): string
    {
        $this->numbers = $this->mapFileToNumbersArray($this->numbers);
        $entries = $this->findTwoEntriesAddingTo2020($this->numbers);
        return $entries[self::FIRST_NUMBER] * $entries[self::SECOND_NUMBER];
    }

    /**
     * @return string
     */
    public function solvePartTwo(): string
    {
        $this->numbers = $this->mapFileToNumbersArray($this->numbers);
        $entries = $this->findThreeEntriesAddingTo2020($this->numbers);

        return ($entries[self::FIRST_NUMBER] * $entries[self::SECOND_NUMBER] * $entries[self::THIRD_NUMBER]);
    }


    /**
     * @param array $numbers
     * @return array
     */
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

        return [];
    }

    /**
     * @param array $numbers
     * @return array
     */
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