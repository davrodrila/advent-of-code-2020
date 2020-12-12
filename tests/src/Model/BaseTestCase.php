<?php

namespace src\Model;

use App\AbstractSolver;
use App\File\FileReader;
use PHPUnit\Framework\TestCase;

abstract class BaseTestCase extends TestCase
{

    protected function generate(array $values)
    {
        return $this->returnCallback(function() use ($values) {
            foreach ($values as $value) {
                yield $value;
            }
        });
    }

    abstract protected function getSolverClass(): string;

    protected function getDaySolverWithTestData(array $data): AbstractSolver {
        /** @var FileReader $fileReader */
        $fileReader = $this->getMockBuilder(FileReader::class)->disableOriginalConstructor()->getMock();
        $fileReader->method('readFile')
            ->will($this->generate($data));
        $solverClass = $this->getSolverClass();

        return new $solverClass($fileReader);
    }
}