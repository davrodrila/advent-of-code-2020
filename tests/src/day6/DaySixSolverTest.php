<?php

namespace src\day6;

use App\day6\DaySixSolver;
use App\File\FileReader;
use src\Model\BaseTestCase;

class DaySixSolverTest extends BaseTestCase
{

    public function testPartOneExampleWorks()
    {
        $groups = ['abc', 'abc', 'abac', 'aaaa', 'b'];
        /** @var FileReader $fileReader */
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
        /** @var FileReader $fileReader */
        $fileReader = $this->getMockBuilder(FileReader::class)->disableOriginalConstructor()
            ->getMock();
        $solver = new DaySixSolver($fileReader);

        $this->assertEquals(6, array_sum($solver->processAnswersGivenByEveryone($groups)));
    }

    protected function getSolverClass(): string
    {
        return DaySixSolver::class;
    }
}