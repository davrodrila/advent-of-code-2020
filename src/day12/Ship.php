<?php


namespace App\day12;


class Ship extends NavigationSystem
{
    private string $facingDirection;

    private int $northSouthPosition = 0;

    private int $eastWestPosition = 0;

    /**
     * Ship constructor.
     */
    public function __construct()
    {
        $this->facingDirection = static::EAST;
    }

    public function move(MovementInstruction $instruction, ?Waypoint $waypoint = null) {
        if ($waypoint) {
            $this->moveTowardsWaypoint($instruction, $waypoint);
        } else {
            $this->moveShip($instruction);
        }
    }

    private function moveShip(MovementInstruction $instruction): void {
        if ($instruction->getMovement() === static::MOVE_FORWARD) {
            $this->moveShip(new MovementInstruction($this->facingDirection, $instruction->getModifier()));
        } elseif ($instruction->getMovement() === static::NORTH) {
            $this->northSouthPosition += $instruction->getModifier();
        } elseif ($instruction->getMovement() === static::SOUTH) {
            $this->northSouthPosition -= $instruction->getModifier();
        } elseif ($instruction->getMovement() === static::EAST) {
            $this->eastWestPosition += $instruction->getModifier();
        } elseif ($instruction->getMovement() === static::WEST) {
            $this->eastWestPosition -= $instruction->getModifier();
        } elseif ($instruction->getMovement() === static::TURN_RIGHT) {
            $this->changeFacingDirections($this->getNumberOfTurns($instruction->getModifier()), static::TRANSITIONS_RIGHT);
        } elseif ($instruction->getMovement() === static::TURN_LEFT) {
            $this->changeFacingDirections($this->getNumberOfTurns($instruction->getModifier()), static::TRANSITIONS_LEFT);
        }
    }

    private function moveTowardsWaypoint(MovementInstruction $instruction, Waypoint $waypoint): void
    {
        if ($instruction->getMovement() === static::MOVE_FORWARD) {

        }
    }

    private function changeFacingDirections(int $numberOfTurns, array $transitions): void {
        for ($i=0;$i<$numberOfTurns;$i++) {
            $this->facingDirection = $transitions[$this->facingDirection];
        }
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
}