<?php


namespace App\day12;


class Ship
{
    private const NORTH = 'N';

    private const SOUTH = 'S';

    private const WEST = 'W';

    private const EAST = 'E';

    private const TURN_LEFT = 'L';

    private const TURN_RIGHT = 'R';

    private const MOVE_FORWARD = 'F';

    const TURN_FACTOR = 90;

    private string $facingDirection;

    private int $northSouthPosition = 0;

    private int $eastWestPosition = 0;

    private const TRANSITIONS_RIGHT = [
        "N" => "E",
        "E" => "S",
        "S" => "W",
        "W" => "N"
    ];

    private const TRANSITIONS_LEFT = [
        "N" => "W",
        "E" => "N",
        "S" => "E",
        "W" => "S"
    ];

    /**
     * Ship constructor.
     */
    public function __construct()
    {
        $this->facingDirection = static::EAST;
    }

    public function move(MovementInstruction $instruction) {
        if ($instruction->getMovement() === static::MOVE_FORWARD) {
            $this->move(new MovementInstruction($this->facingDirection, $instruction->getModifier()));
        } elseif ($instruction->getMovement() === static::NORTH) {
            $this->northSouthPosition += $instruction->getModifier();
        } elseif ($instruction->getMovement() === static::SOUTH) {
            $this->northSouthPosition -= $instruction->getModifier();
        } elseif ($instruction->getMovement() === static::EAST) {
            $this->eastWestPosition += $instruction->getModifier();
        } elseif ($instruction->getMovement() === static::WEST) {
            $this->eastWestPosition -= $instruction->getModifier();
        } elseif ($instruction->getMovement() === static::TURN_RIGHT) {
            $this->changeFacingDirections(($instruction->getModifier() / self::TURN_FACTOR), static::TRANSITIONS_RIGHT);
        } elseif ($instruction->getMovement() === static::TURN_LEFT) {
            $this->changeFacingDirections(($instruction->getModifier() / self::TURN_FACTOR), static::TRANSITIONS_LEFT);
        }
    }

    private function changeFacingDirections(int $numberOfTurns, array $transitions) {
        for ($i=0;$i<$numberOfTurns;$i++) {
            $this->facingDirection = $transitions[$this->facingDirection];
        }
    }


    public function getManhattanDistance(): int
    {
        return abs($this->northSouthPosition) + abs($this->eastWestPosition);
    }

}