<?php


namespace App\day11;


class Ferry
{
    const OCCUPIED_SEATS_TO_FREE = 4;

    /** @var array|Seat[] $seats */
    private array $seats;

    /**
     * Ferry constructor.
     * @param Seat[]|array $seats
     */
    public function __construct(array $seats)
    {
        $this->seats = $seats;
    }

    public function arrangeSeats(): int {
        $seatChanges = 0;
        $toBeOccupiedSeats = [];
        $toBeOpenSeats = [];
        foreach ($this->seats as $row) {
            /** @var Seat $seat */
            foreach ($row as $seat) {
                if ($this->canSeatBeOccupied($seat)) {
                    $seatChanges++;
                    $toBeOccupiedSeats[] = $seat;
                }
                if ($this->shouldSeatBeFreed($seat)) {
                    $seatChanges++;
                    $toBeOpenSeats[] = $seat;
                }
            }
        }
        foreach ($toBeOccupiedSeats as $seat) {
            $seat->markAsOccupied();
        }

        foreach ($toBeOpenSeats as $seat) {
            $seat->markAsOpen();
        }
        return $seatChanges;
    }

    public function canSeatBeOccupied(Seat $seat): bool {
        if ($seat->isOccupied() || $seat->isFloor()) {
            return false;
        }

        if ($this->doesTheSeatHaveAdjacentFreeSeats($seat)) {
            return true;
        }

        return false;
    }

    private function doesTheSeatHaveAdjacentFreeSeats(Seat $seat): bool {
        $adjacentSeats = $this->getAdjacentSeats($seat);

        /** @var Seat|null $adjacentSeat */
        foreach ($adjacentSeats as $adjacentSeat) {
            if ($adjacentSeat && $adjacentSeat->isOccupied()) {
                return false;
            }
        }

        return true;
    }

    private function getAdjacentSeats(Seat $seat): array {
        $adjacentSeats[] = $this->getSeatAt($seat->getRow() - 1, $seat->getColumn() - 1);
        $adjacentSeats[] = $this->getSeatAt($seat->getRow() - 1, $seat->getColumn());
        $adjacentSeats[] = $this->getSeatAt($seat->getRow() - 1, $seat->getColumn() + 1);
        $adjacentSeats[] = $this->getSeatAt($seat->getRow(), $seat->getColumn() - 1);
        $adjacentSeats[] = $this->getSeatAt($seat->getRow(), $seat->getColumn() + 1);
        $adjacentSeats[] = $this->getSeatAt($seat->getRow() + 1, $seat->getColumn() -1);
        $adjacentSeats[] = $this->getSeatAt($seat->getRow() + 1, $seat->getColumn());
        $adjacentSeats[] = $this->getSeatAt($seat->getRow() + 1, $seat->getColumn() + 1);

        return $adjacentSeats;
    }

    public function getSeatAt(int $row, int $column): ?Seat
    {
        if (isset($this->seats[$row]) && isset($this->seats[$row][$column])) {
            return $this->seats[$row][$column];
        }

        return null;
    }

    public function getOccupiedSeats(): int
    {
        $occupied = 0;
        foreach ($this->seats as $row)
        {
            /** @var Seat $seat */
            foreach ($row as $seat) {
                if ($seat->isOccupied()) {
                    $occupied++;
                }
            }
        }

        return $occupied;
    }

    public function print(): string {
        $output = '';
        foreach ($this->seats as $row) {
            foreach ($row as $seat) {
                $output .= $seat;
            }
            $output .= PHP_EOL;
        }

        return $output;
    }

    private function shouldSeatBeFreed(Seat $seat)
    {
        if (!$seat->isOccupied()) {
            return false;
        }

        $adjacentSeats = $this->getAdjacentSeats($seat);
        $occupiedSeatsNumber = 0;

        /** @var Seat $adjacentSeat */
        foreach ($adjacentSeats as $adjacentSeat) {
            if ($adjacentSeat && $adjacentSeat->isOccupied()) {
                $occupiedSeatsNumber++;
            }
        }

        return $occupiedSeatsNumber >= self::OCCUPIED_SEATS_TO_FREE;
    }
}