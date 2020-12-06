<?php


namespace App\day5;

use App\AbstractSolver;

class DayFiveSolver extends AbstractSolver
{
    /** @var string[]|array $boardingTickets */
    private array $boardingTickets = [];

    /** @var Seat[] $seats */
    private array $seats;

    /**
     * @return string
     */
    public function solvePartOne(): string
    {
        $this->initialize();
        $highestBoardingPass = new Seat(0, 0);
        foreach ($this->boardingTickets as $boardingPassTicket) {
            $processedSeat = $this->makeSeatFromBoardingPass($boardingPassTicket);
            $this->seats[] = $processedSeat;
            if ($highestBoardingPass->getSeatId() < $processedSeat->getSeatId()) {
                $highestBoardingPass = $processedSeat;
            }
        }

        return $highestBoardingPass->getSeatId();
    }

    /**
     * @param string $boardingPassTicket
     * @return Seat
     */
    public function makeSeatFromBoardingPass(string $boardingPassTicket): Seat
    {
        $row = $this->getRow($boardingPassTicket);
        $column = $this->getColumn($boardingPassTicket);

        return new Seat($row, $column);
    }

    /**
     * @param string $boardingPassTicket
     * @return int
     */
    private function getRow(string $boardingPassTicket): int
    {
        $rowBinaryString = substr(
            $boardingPassTicket,
            ChallengeValues::BOARDING_PASS_COLUMN_START,
            ChallengeValues::BOARDING_PASS_COLUMN_LENGTH - 1
        );

        return $this->resolveBinaryString(
            $rowBinaryString,
            $boardingPassTicket[ChallengeValues::BOARDING_PASS_COLUMN_LENGTH-1],
            ChallengeValues::FRONT_VALUE,
            ChallengeValues::AIRPLANE_MAX_ROWS
        );
    }

    /**
     * @param string $boardingPassTicket
     * @return int
     */
    private function getColumn(string $boardingPassTicket): int
    {
        $columnBinaryString = substr(
            $boardingPassTicket,
            ChallengeValues::BOARDING_PASS_ROW_START,
            ChallengeValues::BOARDING_PASS_ROW_LENGTH - 1
        );

        return $this->resolveBinaryString(
            $columnBinaryString,
            $boardingPassTicket[(ChallengeValues::BOARDING_PASS_COLUMN_LENGTH +
                ChallengeValues::BOARDING_PASS_ROW_LENGTH)-1],
            ChallengeValues::LEFT_VALUE,
            ChallengeValues::AIRPLANE_MAX_COLS
        );
    }

    /**
     * @param string $binaryString
     * @param string $finalCharacter
     * @param string $lowerHalfValue
     * @param string $maxRows
     *
     * @return int
     */
    private function resolveBinaryString(
        string $binaryString,
        string $finalCharacter,
        string $lowerHalfValue,
        string $maxRows
    ): int {
        $currentSearch = [
            ChallengeValues::MIN_KEY => 0,
            ChallengeValues::MAX_KEY => $maxRows,
        ];
        foreach (str_split($binaryString) as $row) {
            $currentMin = $currentSearch[ChallengeValues::MIN_KEY];
            $currentMax = $currentSearch[ChallengeValues::MAX_KEY];
            $diff = $currentMax + $currentMin;
            if ($row === $lowerHalfValue) {
                $currentMax = round($diff/2.0, 0, PHP_ROUND_HALF_DOWN);
            } else {
                $currentMin = round($diff/2.0, 0, PHP_ROUND_HALF_UP);
            }

            $currentSearch = [
                ChallengeValues::MIN_KEY => $currentMin,
                ChallengeValues::MAX_KEY => $currentMax,
            ];
        }

        return ($finalCharacter === $lowerHalfValue ?
            $currentSearch[ChallengeValues::MIN_KEY] :
            $currentSearch[ChallengeValues::MAX_KEY]
        );
    }

    /**
     *
     */
    protected function initialize()
    {
        if (!$this->boardingTickets) {
            $this->boardingTickets = $this->fileToArrayAsValue();
        }
    }

    /**
     * @return string
     */
    public function solvePartTwo(): string
    {
        $this->initialize();

        $ids = $this->getSortedSeatsIds();

        foreach ($ids as $id => $value) {
            $nextSeat = $id+1;
            $isNextSeatOccupied = isset($ids[$nextSeat]);
            if (!$isNextSeatOccupied) {
                return $nextSeat;
            }
        }

        return 'Seat not found!';
    }

    /**
     * @return array
     */
    private function getSortedSeatsIds(): array {
        $ids = [];
        foreach ($this->seats as $seat) {
            $ids[$seat->getSeatId()] = '';
        }
        ksort($ids);
            
        return $ids;
    }
}