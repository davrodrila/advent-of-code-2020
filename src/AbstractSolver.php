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


    public  function getFileName() {
        return static::$FILE_NAME;
    }
}