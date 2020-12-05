<?php


namespace App\day5;


class Seat
{
    private int $row;

    private int $column;

    /**
     * Seat constructor.
     * @param int $row
     * @param int $column
     */
    public function __construct(int $row, int $column)
    {
        $this->row = $row;
        $this->column = $column;
    }

    /**
     * @return int
     */
    public function getRow(): int
    {
        return $this->row;
    }

    /**
     * @return int
     */
    public function getColumn(): int
    {
        return $this->column;
    }

    public function getSeatId(): string
    {
        return ($this->row * ChallengeValues::ROW_MULTIPLIER + $this->column);
    }
}