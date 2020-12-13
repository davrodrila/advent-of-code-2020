<?php


namespace App\day12;


abstract class NavigationSystem
{
    protected const NORTH = 'N';

    protected const SOUTH = 'S';

    protected const WEST = 'W';

    protected const EAST = 'E';

    protected const TURN_LEFT = 'L';

    protected const TURN_RIGHT = 'R';

    protected const MOVE_FORWARD = 'F';

    protected const TURN_FACTOR = 90;

    protected const TRANSITIONS_RIGHT = [
        "N" => "E",
        "E" => "S",
        "S" => "W",
        "W" => "N"
    ];

    protected const TRANSITIONS_LEFT = [
        "N" => "W",
        "E" => "N",
        "S" => "E",
        "W" => "S"
    ];

    protected function getNumberOfTurns(int $degrees) {
        return ($degrees / static::TURN_FACTOR);
    }

    /**
     * @return int
     */
    public abstract function getEastWestPosition(): int;

    /**
     * @return int
     */
    public abstract function getNorthSouthPosition(): int;

    public function getManhattanDistance(): int
    {
        return abs($this->getNorthSouthPosition()) + abs($this->getEastWestPosition());
    }
}