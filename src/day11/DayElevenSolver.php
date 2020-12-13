<?php


namespace App\day11;


use App\AbstractSolver;

class DayElevenSolver extends AbstractSolver
{

    private Ferry $ferry;

    public function solvePartOne(): string
    {
         $this->initialize();

         do {
             $movingSeats = $this->ferry->arrangeSeats();
         } while ($movingSeats !== 0);

         return $this->ferry->getOccupiedSeats();
    }

    private function initialize(int $minimumOccupiedSeats = 4) {
        if (!isset($this->ferry)) {
            $this->ferry = $this->createFerryFromInput($minimumOccupiedSeats);
        }
    }

    private function createFerryFromInput(int $minimumOccupiedSeats) {
        $row = 0;
        $seats = [];
        foreach($this->fileReader->readFile() as $line) {
            $column = 0;
            foreach (str_split($line) as $char) {
                $seats[$row][$column] = new Seat($column, $row, $char);
                $column++;
            }
            $row++;
        }

        return new Ferry($seats, $minimumOccupiedSeats);
    }

    public function getFerry(): Ferry {
        $this->initialize();

        return $this->ferry;
    }

    public function solvePartTwo(): string
    {
        $this->initialize(5);

        return '??';
    }
}