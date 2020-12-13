<?php


namespace App\day12;


class Waypoint extends NavigationSystem
{
    private const DEFAULT_EAST_POSITION = 10;

    private const DEFAULT_NORTH_POSITION = 1;

    private int $eastWestPosition;

    private int $northSouthPosition;

    private string $facingDirection;

    /**
     * Waypoint constructor.
     */
    public function __construct()
    {
        $this->northSouthPosition = static::DEFAULT_NORTH_POSITION;
        $this->eastWestPosition = static::DEFAULT_EAST_POSITION;
        $this->facingDirection = static::EAST;
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
            var_dump(sprintf("Waypoint moves to the north %s east %s", $this->northSouthPosition, $this->eastWestPosition));
        } elseif ($instruction->getMovement() === static::SOUTH) {
            $this->northSouthPosition -= $instruction->getModifier();
            var_dump(sprintf("Waypoint moves to the north %s east %s", $this->northSouthPosition, $this->eastWestPosition));
        } elseif ($instruction->getMovement() === static::EAST) {
            $this->eastWestPosition += $instruction->getModifier();
            var_dump(sprintf("Waypoint moves to the north %s east %s", $this->northSouthPosition, $this->eastWestPosition));
        } elseif ($instruction->getMovement() === static::WEST) {
            $this->eastWestPosition -= $instruction->getModifier();
            var_dump(sprintf("Waypoint moves to the north %s east %s", $this->northSouthPosition, $this->eastWestPosition));
        } elseif ($instruction->getMovement() === static::TURN_RIGHT || $instruction->getMovement() === static::TURN_LEFT) {
            $this->rotateAroundShip($instruction);
        }
    }

    private function rotateAroundShip(MovementInstruction $instruction) {
        $degrees = ($instruction->getMovement() === static::TURN_RIGHT ? 360 - $instruction->getModifier() : $instruction->getModifier());
        $rads = $degrees * (pi() / 180);
        $rotatedNorth = round($this->eastWestPosition * sin($rads) + $this->northSouthPosition * cos($rads));
        $rotatedEast = round($this->eastWestPosition * cos($rads) - $this->northSouthPosition * sin($rads));
        var_dump(sprintf("Rotating waypoint to north %s and east %s", $rotatedNorth, $rotatedEast));
        $this->northSouthPosition = $rotatedNorth;
        $this->eastWestPosition = $rotatedEast;

    }
}