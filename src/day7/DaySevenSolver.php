<?php


namespace App\day7;


use App\AbstractSolver;
use App\File\FileReader;

class DaySevenSolver extends AbstractSolver
{

    /** @var Bag[]|array $bags */
    private array $bags;

    /**
     * DaySevenSolver constructor.
     * @param FileReader $fileReader
     */
    public function __construct(FileReader $fileReader)
    {
        parent::__construct($fileReader);
        $this->bags = $this->parseBags();
    }

    private function parseBags(): array {
        foreach ($this->fileReader->readFile() as $line) {
            $rules = preg_split( ChallengeValues::RULE_SEPARATOR_VALUE_REGEX, $line);
            $affectedBag = trim(preg_replace(ChallengeValues::BAG_REMOVAL_REGEX,'', $rules[0]));
            $bagRules = $this->parseBagRules($rules[1]);
            $this->bags[$affectedBag] = new Bag($affectedBag, $bagRules);
        }
        return $this->bags;
    }

    /**
     * @param string $rules
     * @return BagRule[]|array|null
     */
    private function parseBagRules(string $rules): ?array {
        $cleanedRules = trim(
            preg_replace(
                ChallengeValues::BAG_REMOVAL_REGEX,
                '',
                str_replace('.',
                            '',
                            $rules
                )
            )
        );
        if ($cleanedRules === ChallengeValues::NO_OTHER_BAGS) {
            return null;
        }

        $colorRuling = preg_split(ChallengeValues::VALID_CONTAINER_SEPARATOR_REGEX, $cleanedRules);
        $bagRules = [];
        foreach ($colorRuling as $color) {
            $bagRules[] = new BagRule(
                substr(trim($color), 0, 1),
                trim(substr(trim($color), 2)
                )
            );
        }

        return $bagRules;
    }

    /**
     * @return string
     */
    public function solvePartOne(): string
    {
        $bags = $this->getBagsThatCanCarryTheBag($this->bags[ChallengeValues::BAG_TO_RESOLVE]);

        return count($bags);
    }

    /**
     * @param Bag $currentBag
     * @return Bag[]|array
     */
    private function getBagsThatCanCarryTheBag(Bag $currentBag): array
    {
        $baggableBag = [];
        foreach ($this->bags as $bag) {
            if ($bag->hasBagRules()) {
                if ($bag->canContain($currentBag->getColor())) {
                    if (!in_array($bag->getColor(), $baggableBag)) {
                        $baggableBag[$bag->getColor()] = $bag;
                    }

                    $additionalBagableBags = $this->getBagsThatCanCarryTheBag($bag);
                    foreach ($additionalBagableBags as $additionalBagableBag) {
                        $baggableBag[$additionalBagableBag->getColor()] = $additionalBagableBag;
                    }
                }
            }
        }

        return $baggableBag;
    }

    /**
     * @return string
     */
    public function solvePartTwo(): string
    {
        $bag = $this->bags[ChallengeValues::BAG_TO_RESOLVE];

        return ($this->calculateBagsNeededForABag($bag));
    }

    /**
     * @param Bag $bag
     *
     * @return int
     */
    private function calculateBagsNeededForABag(Bag $bag): int
    {
        $quantity = 0;
        if ($bag->hasBagRules()) {
            foreach ($bag->getBagRules() as $rule) {
                $quantity += $rule->getQuantity() + ($this->resolveRule($rule) * $rule->getQuantity());
            }
        }

        return $quantity;
    }

    private function resolveRule(BagRule $rule)
    {
        $bag = $this->bags[$rule->getColor()];
        if ($bag->hasBagRules()) {
            $quantity = 0;
            foreach ($bag->getBagRules() as $subRule) {
                $quantity += $subRule->getQuantity() + ($this->resolveRule($subRule) * $subRule->getQuantity());
            }
            return $quantity;
        } else {
            return 0;
        }
    }
}