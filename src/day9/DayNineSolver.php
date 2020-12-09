<?php


namespace App\day9;


use App\AbstractSolver;

class DayNineSolver extends AbstractSolver
{

    private const PREAMBLE = 25;

    private array $numbers = [];

    public function solvePartOne(): string
    {
        $this->initialize();
        $xmas = new XMAS(static::PREAMBLE, $this->numbers);

        return $xmas->lookForInvalidNumber();
    }

    private function initialize(): void
    {
        if (count($this->numbers) === 0) {
            $rawNumbers = $this->fileToArrayAsValue();
            $this->numbers = array_map(function ($line) {
                return intval($line);
            }, $rawNumbers);
        }
    }

    public function solvePartTwo(): string
    {
        $this->initialize();
        $xmas = new XMAS(static::PREAMBLE, $this->numbers);

        return $xmas->findEncryptionWeakness($xmas->lookForInvalidNumber());
    }
}