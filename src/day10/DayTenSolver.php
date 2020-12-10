<?php

namespace App\day10;

use App\AbstractSolver;

class DayTenSolver extends AbstractSolver
{

    private array $adapters = [];

    public function solvePartOne(): string
    {
        $this->initialize();

        return $this->findAdapterMultiplier();
    }

    private function findAdapterMultiplier()
    {
        $oneVoltDifferences = 0;
        $threeVoltDifferences = 1; //Device is capable of a three volt difference
        $adapterList = array_flip($this->adapters);
        if (isset($adapterList[1])) {
            $oneVoltDifferences++;
        } elseif (isset($adapterList[3])) {
            $oneVoltDifferences++;
        }
        foreach ($adapterList as $adapter => $val) {
            if (isset($adapterList[$adapter+1])) {
                $oneVoltDifferences++;
            } elseif (isset($adapterList[$adapter+3])) {
                $threeVoltDifferences++;
            }
        }

        return $oneVoltDifferences * $threeVoltDifferences;
    }

    public function solvePartTwo(): string
    {
        return '';
    }

    private function initialize(): void
    {
        if (!$this->adapters) {
            $result = $this->fileToArrayAsValue();
            sort($result);
            $this->adapters = $result;
        }
    }
}