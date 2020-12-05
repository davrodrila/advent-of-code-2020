<?php

namespace App\day2;

use App\AbstractSolver;

class DayTwoSolver extends AbstractSolver
{
    /** @var Password[]|array  */
    private array $passwords;

    /**
     * @return string
     */
    public function solvePartOne(): string
    {
        if (empty($this->passwords)) {
            $this->passwords = $this->buildPasswordCollection();
        }
        $validPasswords = 0;
        foreach($this->passwords as $password) {
            if ($password->isPartOneValid()) {
                $validPasswords++;
            }
        }

        return $validPasswords;
    }

    /**
     * @return string
     */
    public function solvePartTwo(): string
    {
        if (empty($this->passwords)) {
            $this->passwords = $this->buildPasswordCollection();
        }
        $validPasswords = 0;
        foreach($this->passwords as $password) {
            if ($password->isPartTwoValid()) {
                $validPasswords++;
            }
        }

        return $validPasswords;
    }

    /**
     * @return Password[]|array
     */
    private function buildPasswordCollection(): array
    {
        $passwords = [];

        foreach ($this->fileReader->readFile() as $line)
        {
            $parsedLine = preg_split(ChallengeValues::LINE_SEPARATOR_REGEX, $line);
            $passwords[] = new Password(
                $this->getMin($parsedLine[ChallengeValues::APPEARANCES]),
                $this->getMax($parsedLine[ChallengeValues::APPEARANCES]),
                preg_replace(
                    ChallengeValues::APPEARING_STRING_SEPARATOR_REGEX,
                    '',
                    $parsedLine[ChallengeValues::APPEARING_STRING]),
                $parsedLine[ChallengeValues::PASSWORD]);
        }

        return $passwords;
    }

    /**
     * @param string $range
     * @return int
     */
    private function getMin(string $range): int
    {
        $extractedRange = preg_split(ChallengeValues::RANGE_SEPARATOR_REGEX, $range);

        return intval($extractedRange[ChallengeValues::RANGE_MIN]);
    }

    /**
     * @param string $range
     * @return int
     */
    private function getMax(string $range): int
    {
        $extractedRange = preg_split(ChallengeValues::RANGE_SEPARATOR_REGEX, $range);

        return intval($extractedRange[ChallengeValues::RANGE_MAX]);
    }
}