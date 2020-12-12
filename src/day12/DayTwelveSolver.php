<?php


namespace App\day12;


use App\AbstractSolver;

class DayTwelveSolver extends AbstractSolver
{
    /** @var MovementInstruction[] $moves*/
    private array $moves;

    public function solvePartOne(): string
    {
        $this->initialize();
        $ship = new Ship();
        foreach ($this->moves as $move) {
            $ship->move($move);
        }

        return $ship->getManhattanDistance();
    }

    public function solvePartTwo(): string
    {
        return '??';
    }

    private function initialize() {
        if (!isset($this->moves)) {
            $this->moves = $this->readMovesFromFile();
        }
    }

    /**
     * @return MovementInstruction[]
     */
    private function readMovesFromFile(): array {
        $movements = [];
        foreach ($this->fileReader->readFile() as $line) {
            $movements[] = new MovementInstruction($line[0], substr($line, 1));
        }

        return $movements;
    }
}