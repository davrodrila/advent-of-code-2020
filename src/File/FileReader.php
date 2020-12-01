<?php


namespace App\File;


use Generator;

class FileReader
{
    private const FILE_NAME = 'input.txt';

    private $file;
    /**
     * FileReader constructor.
     */
    public function __construct(string $day)
    {
        $this->file = fopen(__DIR__ . '/../../Resources/' . $day . '/' . static::FILE_NAME, 'r');
    }


    public function readFile(): Generator {
        while(($line = fgets($this->file)) !== false)
            yield rtrim($line, "\r\n");

        fclose($this->file);
    }

}