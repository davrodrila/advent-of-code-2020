<?php


namespace App\day7;


class BagRule
{
    private int $quantity;

    private string $color;

    /**
     * BagRule constructor.
     * @param int $quantity
     * @param string $color
     */
    public function __construct(int $quantity, string $color)
    {
        $this->quantity = $quantity;
        $this->color = $color;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }
}