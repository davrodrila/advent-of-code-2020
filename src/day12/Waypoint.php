<?php


namespace App\day12;


class Waypoint extends NavigationSystem
{
    private const DEFAULT_EAST_POSITION = 10;

    private const DEFAULT_NORTH_POSITION = 1;

    private int $eastWestPosition;

    private int $northSouthPosition;

    /**
     * Waypoint constructor.
     */
    public function __construct()
    {
        $this->northSouthPosition = static::DEFAULT_NORTH_POSITION;
        $this->eastWestPosition = static::DEFAULT_EAST_POSITION;
    }

    /**
     * @return int
     */
    public function getEastWestPosition(): int
    {
        return $this->eastWestPosition;
    }

    /**
     * @return int
     */
    public function getNorthSouthPosition(): int
    {
        return $this->northSouthPosition;
    }

    public function move(MovementInstruction $instruction)
    {
        if ($instruction->getMovement() === static::NORTH) {
            $this->northSouthPosition += $instruction->getModifier();
        } elseif ($instruction->getMovement() === static::SOUTH) {
            $this->northSouthPosition -= $instruction->getModifier();
        } elseif ($instruction->getMovement() === static::EAST) {
            $this->eastWestPosition += $instruction->getModifier();
        } elseif ($instruction->getMovement() === static::WEST) {
            $this->eastWestPosition -= $instruction->getModifier();
        } elseif ($instruction->getMovement() === static::TURN_LEFT) {

        } elseif ($instruction->getMovement() === static::TURN_RIGHT) {

        }
    }
}