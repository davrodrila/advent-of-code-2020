<?php


namespace App\day3;


use App\File\FileReader;

class Map
{
    private int $xPosition;

    private int $yPosition;

    private int $yLength;

    private int $xLength;

    private array $map;

    /**
     * Map constructor.
     * @param FileReader $fileReader
     */
    public function __construct(FileReader $fileReader)
    {
        $this->xPosition = 0;
        $this->yPosition = 0;
        $this->map = $this->parseMap($fileReader);
    }

    /**
     * @param FileReader $fileReader
     * @return array
     */
    private function parseMap(FileReader $fileReader): array
    {
        $xPosition = 0;
        $yPosition = 0;
        $map = [];
        foreach ($fileReader->readFile() as $line) {
           foreach(str_split($line) as $indexedLine) {
               $map[$yPosition][$xPosition] = $indexedLine;
               $xPosition++;
           }
           $yPosition++;
           $this->xLength = $xPosition;
           $xPosition = 0;
        }
        $this->yLength = $yPosition;

        return $map;
    }

    /**
     * @return bool
     */
    public function isTree(): bool
    {
        return $this->getCharacterAtCurrentPosition() === ChallengeValues::TREE_CHARACTER;
    }


    /**
     * @return bool
     */
    public function isOpen(): bool
    {
        return $this->getCharacterAtCurrentPosition() === ChallengeValues::OPEN_CHARACTER;
    }


    /**
     * @return string
     */
    private function getCharacterAtCurrentPosition(): string
    {
        $offsetX = $this->getWrappedX();
        $offsetY = $this->getWrappedY();

        return $this->map[$offsetY][$offsetX];
    }

    /**
     * @return int
     */
    private function getWrappedX(): int {
        $offsetX = $this->xPosition;
        if ($offsetX >= $this->xLength) {
            $offsetX = $this->xPosition % $this->xLength;
        }

        return $offsetX;
    }

    /**
     * @return int
     */
    private function getWrappedY(): int {
        $offsetY = $this->yPosition;
        if ($offsetY >= $this->yLength ) {
            $offsetY = ($this->yLength-1);
        }

        return $offsetY;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->map;
    }

    /**
     * @param array $slope
     */
    public function doSlope(array $slope)
    {
        foreach ($slope as $move) {
            $this->move($move);
        }

    }

    /**
     * @return bool
     */
    public function hasArrivedToDestiny(): bool
    {
        return $this->yPosition >= $this->yLength;
    }

    /**
     * @param array $slope
     */
    private function move(array $slope)
    {
        if ($slope[ChallengeValues::MOVE_DIRECTION] === ChallengeValues::MOVE_RIGHT) {
            $this->xPosition += $slope[ChallengeValues::MOVE_AMOUNT];
        } elseif ($slope[ChallengeValues::MOVE_DIRECTION] === ChallengeValues::MOVE_DOWN) {
            $this->yPosition += $slope[ChallengeValues::MOVE_AMOUNT];
        }
    }

    public function resetMap()
    {
        $this->xPosition = 0;
        $this->yPosition = 0;
    }
}