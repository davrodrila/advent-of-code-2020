<?php


namespace App\day14;


use App\AbstractSolver;
use App\File\FileReader;

class DayFourteenSolver extends AbstractSolver
{
    private array $instructions;

    private string $mask;

    private array $memory = [];

    /**
     * DayFourteenSolver constructor.
     * @param FileReader $fileReader
     */
    public function __construct(FileReader $fileReader)
    {
        parent::__construct($fileReader);
        $this->instructions = $this->fileToArrayAsValue();
    }


    public function solvePartOne(): string
    {
        $decoder = new Decoder(Decoder::V1);
        foreach ($this->instructions as $line) {
            $command = preg_split("/=/", $line);
            $instruction = trim($command[0]);
            $modifier = trim($command[1]);

            if ($instruction === 'mask') {
                $decoder->setCurrentMask($modifier);
            } else {
                $index = str_replace(']', '', str_replace('[', '', str_replace('mem', '', $instruction)));
                $decoder->processNumber($index, $modifier);
            }
        }
        return $decoder->getMemorySum();
    }


    public function solvePartTwo(): string
    {
        $decoder = new Decoder(Decoder::V2);
        foreach ($this->instructions as $line) {
            $command = preg_split("/=/", $line);
            $instruction = trim($command[0]);
            $modifier = trim($command[1]);

            if ($instruction === 'mask') {
                $decoder->setCurrentMask($modifier);
            } else {
                $index = str_replace(']', '', str_replace('[', '', str_replace('mem', '', $instruction)));
                $decoder->processNumber($index, $modifier);
            }
        }
        return $decoder->getMemorySum();
    }
}