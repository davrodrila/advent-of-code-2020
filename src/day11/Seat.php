<?php


namespace App\day11;


class Seat
{
    const OCCUPIED_STATE = '#';
    const FLOOR_STATE = ".";
    const OPEN_STATE = "L";

    private int $column;

    private int $row;

    private string $state;

    /**
     * Seat constructor.
     * @param int $column
     * @param int $row
     * @param string $state
     */
    public function __construct(int $column, int $row, string $state)
    {
        $this->column = $column;
        $this->row = $row;
        $this->state = $state;
    }

    /**
     * @return int
     */
    public function getColumn(): int
    {
        return $this->column;
    }

    /**
     * @return int
     */
    public function getRow(): int
    {
        return $this->row;
    }

    public function markAsOccupied(): void
    {
        $this->state = self::OCCUPIED_STATE;
    }

    public function isOccupied(): bool {
        return $this->state === self::OCCUPIED_STATE;
    }

    public function isFloor(): bool {
        return $this->state === self::FLOOR_STATE;
    }

    public function isOpen(): bool {
        return $this->state === self::OPEN_STATE;
    }

    public function __toString(): string
    {
        return $this->state;
    }

    public function markAsOpen()
    {
        $this->state = static::OPEN_STATE;
    }


}