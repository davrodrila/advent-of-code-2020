<?php


namespace App\File;


use Generator;

class FileReader
{
    protected const DEFAULT_FILE_NAME = 'input.txt';

    protected const DEFAULT_RESOURCES_FOLDER = 'Resources';

    private $file;

    /**
     * FileReader constructor.
     * @param string $day
     * @param string|null $fileName
     * @param string|null $resourcesFolder
     */
    public function __construct(string $day, ?string $fileName = '', ?string $resourcesFolder = '' )
    {
        if (!$fileName) {
            $fileName = static::DEFAULT_FILE_NAME;
        }
        if (!$resourcesFolder) {
            $resourcesFolder = static::DEFAULT_RESOURCES_FOLDER;
        }

        $this->file = fopen(__DIR__ . '/../../' .
            $resourcesFolder . '/' . $day . '/' . $fileName, 'r');
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