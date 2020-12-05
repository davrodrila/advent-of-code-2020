<?php

namespace App\day1;

use App\AbstractSolver;

class DayOneSolver extends AbstractSolver
{


    /** @var array $numbers */
    private array $numbers = [];

    /**
     * @return string
     */
    public function solvePartOne(): string
    {
        $this->numbers = $this->mapFileToNumbersArray($this->numbers);
        $entries = $this->findTwoEntriesAddingTo2020($this->numbers);
        return $entries[ChallengeValues::FIRST_NUMBER] * $entries[ChallengeValues::SECOND_NUMBER];
    }

    /**
     * @return string
     */
    public function solvePartTwo(): string
    {
        $this->numbers = $this->mapFileToNumbersArray($this->numbers);
        $entries = $this->findThreeEntriesAddingTo2020($this->numbers);

        return ($entries[ChallengeValues::FIRST_NUMBER] * $entries[ChallengeValues::SECOND_NUMBER] * $entries[ChallengeValues::THIRD_NUMBER]);
    }


    /**
     * @param array $numbers
     * @return array
     */
    private function findTwoEntriesAddingTo2020(array $numbers): array
    {
        foreach ($numbers as $number => $value) {
            $firstNumber = ChallengeValues::NUMBER_TO_ADD_TO - $number;
            if (isset($numbers[$firstNumber])) {
                return [
                    ChallengeValues::FIRST_NUMBER => $number,
                    ChallengeValues::SECOND_NUMBER => $firstNumber
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
                    $thirdNumber = ChallengeValues::NUMBER_TO_ADD_TO - $firstNumber - $secondNumber;
                    if (isset($numbers[$thirdNumber])) {
                        return [
                            ChallengeValues::FIRST_NUMBER => $firstNumber,
                            ChallengeValues::SECOND_NUMBER => $secondNumber,
                            ChallengeValues::THIRD_NUMBER => $thirdNumber
                        ];
                    }
                }
            }
        }

        return [];
    }
}