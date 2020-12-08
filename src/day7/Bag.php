<?php


namespace App\day7;


class Bag
{
    /** @var string $color */
    private string $color;

    /** @var BagRule[]|array|null  */
    private ?array $bagRules;

    /**
     * @param string $color
     * @param BagRule[]|array|null $bagRules
     */
    public function __construct(string $color, ?array $bagRules)
    {
        $this->color = $color;
        $this->bagRules = $bagRules;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @return BagRule[]|null
     */
    public function getBagRules(): ?array
    {
        return $this->bagRules;
    }

    /**
     * @return bool
     */
    public function hasBagRules(): bool {
        return $this->bagRules !== null;
    }

    /**
     * @param string $bagColor
     * @return bool
     */
    public function canContain(string $bagColor) {
        if ($this->hasBagRules()) {
            foreach ($this->bagRules as $rule) {
                if ($rule->getColor() === $bagColor) {
                    return true;
                }
            }
        }

        return false;
    }
}