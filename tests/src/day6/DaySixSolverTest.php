<?php


namespace src\day6;


use App\day6\DaySixSolver;
use App\File\FileReader;
use PHPUnit\Framework\TestCase;

class DaySixSolverTest extends TestCase
{

    public function testPartOneExampleWorks()
    {
        $groups = ['abc', 'abc', 'abac', 'aaaa', 'b'];

        $fileReader = $this->getMockBuilder(FileReader::class)->disableOriginalConstructor()
            ->getMock();
        $solver = new DaySixSolver($fileReader);

        $this->assertEquals(11, array_sum($solver->processAnswersGivenByAnyone($groups)));
    }

    public function testPartTwoExampleWorks()
    {
        $groups = [
            [
                'abc'
            ],
            [
                'a','b','c'
            ],[
                'ab', 'ac'
            ],
            [
                'a','a','a','a'
            ], [
                'b'
            ]
        ];
        $fileReader = $this->getMockBuilder(FileReader::class)->disableOriginalConstructor()
            ->getMock();
        $solver = new DaySixSolver($fileReader);

        $this->assertEquals(6, array_sum($solver->processAnswersGivenByEveryone($groups)));
    }
}