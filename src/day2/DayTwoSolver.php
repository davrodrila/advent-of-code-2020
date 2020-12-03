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
            $parsedLine = preg_split(FileStructure::LINE_SEPARATOR, $line);
            $passwords[] = new Password(
                $this->getMin($parsedLine[FileStructure::APPEARANCES]),
                $this->getMax($parsedLine[FileStructure::APPEARANCES]),
                preg_replace(
                    FileStructure::APPEARING_STRING_SEPARATOR,
                    '',
                    $parsedLine[FileStructure::APPEARING_STRING]),
                $parsedLine[FileStructure::PASSWORD]);
        }

        return $passwords;
    }

    /**
     * @param string $range
     * @return int
     */
    private function getMin(string $range): int
    {
        $extractedRange = preg_split(FileStructure::RANGE_SEPARATOR, $range);

        return intval($extractedRange[FileStructure::RANGE_MIN]);
    }

    /**
     * @param string $range
     * @return int
     */
    private function getMax(string $range): int
    {
        $extractedRange = preg_split(FileStructure::RANGE_SEPARATOR, $range);

        return intval($extractedRange[FileStructure::RANGE_MAX]);
    }
}