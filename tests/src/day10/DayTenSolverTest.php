<?php

namespace src\day10;

use App\day10\DayTenSolver;
use App\File\FileReader;
use PHPUnit\Framework\TestCase;

class DayTenSolverTest extends TestCase
{

    private function generate(array $values)
    {
        return $this->returnCallback(function() use ($values) {
            foreach ($values as $value) {
                yield $value;
            }
        });
    }

    public function testWebFirstCase()
    {
        /** @var FileReader $fileReader */
        $fileReader = $this->getMockBuilder(FileReader::class)->disableOriginalConstructor()->getMock();
        $fileReader->method('readFile')
            ->will($this->generate([16,10,15,5,1,11,7,19,6,12,4]));

        $solver = new DayTenSolver($fileReader);

        $this->assertEquals(35, $solver->solvePartOne());
    }

    public function testWebSecondCase()
    {
        /** @var FileReader $fileReader */
        $fileReader = $this->getMockBuilder(FileReader::class)->disableOriginalConstructor()->getMock();
        $fileReader->method('readFile')
            ->will($this->generate([28,33,18,42,31,14,46,20,48,47,24,23,49,45,19,38,39,11,1,32,25,35,8,17,7,9,4,2,34,10, 3]));

        $solver = new DayTenSolver($fileReader);

        $this->assertEquals(220, $solver->solvePartOne());
    }
}