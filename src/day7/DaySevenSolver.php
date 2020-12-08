<?php


namespace App\day7;


use App\AbstractSolver;
use App\File\FileReader;

class DaySevenSolver extends AbstractSolver
{

    /** @var array $bagRules */
    private array $bagRules;

    /**
     * DaySevenSolver constructor.
     * @param FileReader $fileReader
     */
    public function __construct(FileReader $fileReader)
    {
        parent::__construct($fileReader);
        $this->bagRules = $this->getBagRules();
    }

    private function getBagRules(): array {
        $bagRules = [];
        foreach ($this->fileReader->readFile() as $line) {
            $rules = preg_split( ChallengeValues::RULE_SEPARATOR_VALUE_REGEX, $line);
            $affectedBag = trim($rules[0]);
            $allowedBags = array_merge(array_map(function ($bags) {
                $cleanedBags = trim($bags);
                $quantity = ($cleanedBags === ChallengeValues::NO_OTHER_BAGS ? '0' : $cleanedBags[0]) ;
                if ($quantity === '0') {
                    return null;
                }
                $bag = str_replace('.', '', trim(substr($cleanedBags,2)));
                if ($quantity === '1') {
                    $bag .= 's'; # make all bag plurals for ease of use.
                }
                return [$bag => $quantity];
            }, preg_split(ChallengeValues::VALID_CONTAINER_SEPARATOR_REGEX, $rules[1])));
            if ($allowedBags[0] !== null) {
                $bagRules[$affectedBag] = $allowedBags;
            }
        }

        return $bagRules;
    }

    public function solvePartOne(): string
    {
        var_dump($this->findBagRules($this->bagRules, ChallengeValues::BAGS_TO_RESOLVE));
        return count($this->findBagRules($this->bagRules,ChallengeValues::BAGS_TO_RESOLVE));
    }

    /**
     * @param array $bagRules
     * @param string $bagToResolve
     *
     * @return array
     */
    public function findBagRules(array $bagRules, string $bagToResolve): array {
        $validBags = [];

        if (isset($bagRules[$bagToResolve])) {
            $bagValidContainers = $bagRules[$bagToResolve];
            foreach ($bagValidContainers as $validContainer) {
                foreach ($validContainer as $bagColor => $quantity) {
                    $validBags[$bagColor] = $quantity;
                    $solvedBags = $this->findBagRules($bagRules, $bagColor);
                    foreach ($solvedBags as $solvedBagColor => $solvedBagQuantity) {
                        $validBags[$solvedBagColor] = $solvedBagQuantity;
                    }
                }
            }
        }

        return $validBags;
    }

    public function solvePartTwo(): string
    {
        return '';
    }
}