<?php


namespace App\day12;


class MovementInstruction
{
    private string $movement;

    private int $modifier;

    /**
     * MovementInstruction constructor.
     * @param string $movement
     * @param int $modifier
     */
    public function __construct(string $movement, int $modifier)
    {
        $this->movement = $movement;
        $this->modifier = $modifier;
    }

    /**
     * @return string
     */
    public function getMovement(): string
    {
        return $this->movement;
    }

    /**
     * @return int
     */
    public function getModifier(): int
    {
        return $this->modifier;
    }
}