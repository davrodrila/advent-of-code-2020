<?php


namespace App\File;


use Generator;

class FileReader
{
    private const FILE_NAME = 'input.txt';

    private const RESOURCES_FOLDER = 'Resources';

    private $file;

    /**
     * FileReader constructor.
     */
    public function __construct(string $day)
    {
        $this->file = fopen(__DIR__ . '/../../' .
            static::RESOURCES_FOLDER . '/' . $day . '/' . static::FILE_NAME, 'r');
    }

    /**
     * @return Generator
     */
    public function readFile(): Generator {
        while(($line = fgets($this->file)) !== false)
            yield rtrim($line, "\r\n");

        fclose($this->file);
    }

}