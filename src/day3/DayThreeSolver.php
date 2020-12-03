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
                FileStructure::MOVE_DIRECTION => FileStructure::MOVE_RIGHT,
                FileStructure::MOVE_AMOUNT => 3
            ],
            [
                FileStructure::MOVE_DIRECTION => FileStructure::MOVE_DOWN,
                FileStructure::MOVE_AMOUNT => 1
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
                FileStructure::MOVE_DIRECTION => FileStructure::MOVE_RIGHT,
                FileStructure::MOVE_AMOUNT => 1
                ],
                [
                    FileStructure::MOVE_DIRECTION => FileStructure::MOVE_DOWN,
                    FileStructure::MOVE_AMOUNT => 1
                ],
            ],[
                [
                    FileStructure::MOVE_DIRECTION => FileStructure::MOVE_RIGHT,
                    FileStructure::MOVE_AMOUNT => 3
                ],
                [
                    FileStructure::MOVE_DIRECTION => FileStructure::MOVE_DOWN,
                    FileStructure::MOVE_AMOUNT => 1
                ]
            ], [
                [
                    FileStructure::MOVE_DIRECTION => FileStructure::MOVE_RIGHT,
                    FileStructure::MOVE_AMOUNT => 5,
                ],
                [
                    FileStructure::MOVE_DIRECTION => FileStructure::MOVE_DOWN,
                    FileStructure::MOVE_AMOUNT => 1
                ]
            ], [
                [
                    FileStructure::MOVE_DIRECTION => FileStructure::MOVE_RIGHT,
                    FileStructure::MOVE_AMOUNT => 7,
                ],
                [
                    FileStructure::MOVE_DIRECTION => FileStructure::MOVE_DOWN,
                    FileStructure::MOVE_AMOUNT => 1
                ]
            ], [
                [
                    FileStructure::MOVE_DIRECTION => FileStructure::MOVE_RIGHT,
                    FileStructure::MOVE_AMOUNT => 1,
                ],
                [
                    FileStructure::MOVE_DIRECTION => FileStructure::MOVE_DOWN,
                    FileStructure::MOVE_AMOUNT => 2
                ]
            ]
        ];
    }
}