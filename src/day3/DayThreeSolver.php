<?php


namespace App\day3;


use App\AbstractSolver;
use App\File\FileReader;

class DayThreeSolver extends AbstractSolver
{

    private Map $map;

    /**
     * @return string
     */
    public function solvePartOne(): string
    {
        $this->map = new Map($this->fileReader);
        $slope = $this->buildFirstSlope();
        $treesFound = 0;
        while (!$this->map->hasArrivedToDestiny()) {
            $this->map->doSlope($slope);
            if ($this->map->isTree()) {
                $treesFound++;
            }
        }

        return $treesFound;
    }

    /**
     * @return string
     */
    public function solvePartTwo(): string
    {
        $slopes = $this->buildSecondSlope();
        $trees = [];
        $slopeIndex = 0;
        foreach($slopes as $slope) {
            $trees[$slopeIndex] = 0;
            $this->map->resetMap();
            while (!$this->map->hasArrivedToDestiny()) {
                $this->map->doSlope($slope);
                if ($this->map->isTree()) {
                    $trees[$slopeIndex]++;
                }
            }
            $slopeIndex++;
        }
        return array_product($trees);
    }

    /**
     * @return array[]
     */
    private function buildFirstSlope(): array
    {
        return [
            [
                ChallengeValues::MOVE_DIRECTION => ChallengeValues::MOVE_RIGHT,
                ChallengeValues::MOVE_AMOUNT => 3
            ],
            [
                ChallengeValues::MOVE_DIRECTION => ChallengeValues::MOVE_DOWN,
                ChallengeValues::MOVE_AMOUNT => 1
            ]

        ];
    }

    /**
     * @return array[][]
     */
    private function buildSecondSlope(): array
    {
        return [
            [
                [
                ChallengeValues::MOVE_DIRECTION => ChallengeValues::MOVE_RIGHT,
                ChallengeValues::MOVE_AMOUNT => 1
                ],
                [
                    ChallengeValues::MOVE_DIRECTION => ChallengeValues::MOVE_DOWN,
                    ChallengeValues::MOVE_AMOUNT => 1
                ],
            ],[
                [
                    ChallengeValues::MOVE_DIRECTION => ChallengeValues::MOVE_RIGHT,
                    ChallengeValues::MOVE_AMOUNT => 3
                ],
                [
                    ChallengeValues::MOVE_DIRECTION => ChallengeValues::MOVE_DOWN,
                    ChallengeValues::MOVE_AMOUNT => 1
                ]
            ], [
                [
                    ChallengeValues::MOVE_DIRECTION => ChallengeValues::MOVE_RIGHT,
                    ChallengeValues::MOVE_AMOUNT => 5,
                ],
                [
                    ChallengeValues::MOVE_DIRECTION => ChallengeValues::MOVE_DOWN,
                    ChallengeValues::MOVE_AMOUNT => 1
                ]
            ], [
                [
                    ChallengeValues::MOVE_DIRECTION => ChallengeValues::MOVE_RIGHT,
                    ChallengeValues::MOVE_AMOUNT => 7,
                ],
                [
                    ChallengeValues::MOVE_DIRECTION => ChallengeValues::MOVE_DOWN,
                    ChallengeValues::MOVE_AMOUNT => 1
                ]
            ], [
                [
                    ChallengeValues::MOVE_DIRECTION => ChallengeValues::MOVE_RIGHT,
                    ChallengeValues::MOVE_AMOUNT => 1,
                ],
                [
                    ChallengeValues::MOVE_DIRECTION => ChallengeValues::MOVE_DOWN,
                    ChallengeValues::MOVE_AMOUNT => 2
                ]
            ]
        ];
    }
}