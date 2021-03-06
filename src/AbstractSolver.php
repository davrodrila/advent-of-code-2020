<?php


namespace App;


use App\File\FileReader;

abstract class AbstractSolver
{

    protected static string $FILE_NAME = 'abstract';

    protected FileReader $fileReader;

    /**
     * AbstractSolver constructor.
     * @param FileReader $fileReader
     */
    public function __construct(FileReader $fileReader)
    {
        $this->fileReader = $fileReader;
    }

    public abstract function solvePartOne(): string;

    public abstract function solvePartTwo(): string;

    public  function getFileName() {
        return static::$FILE_NAME;
    }


    protected function mapFileToNumbersArray(array $numbers): array
    {
        if (empty($numbers)) {
            $numbers = $this->fileToArrayAsKey();
        }

        return $numbers;
    }

    /**
     * @return array
     */
    protected function fileToArrayAsValue(): array {
        $lines  = [];
        foreach ($this->fileReader->readFile() as $line) {
            $lines[] = $line;
        }

        return $lines;
    }

    /**
     * @return array
     */
    protected function fileToArrayAsKey(): array {
        $numbers = [];
        foreach ($this->fileReader->readFile() as $line) {
            $numbers[$line] = '';
        }
        return $numbers;
    }

    protected function fileToArrayGroupedUntilBlankLine(): array {
        $lines = [];
        $i=0;
        $lines[$i] = [];
        foreach ($this->fileReader->readFile() as $line) {
            if (empty($line)) {
                $i++;
                $lines[$i] = [];
            } else {
                $lines[$i][] = $line;
            }
        }

        return $lines;
    }
}