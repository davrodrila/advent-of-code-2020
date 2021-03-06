<?php

namespace src\day5;

use App\day5\DayFiveSolver;
use App\File\FileReader;
use src\Model\BaseTestCase;

class DayFiveSolverTest extends BaseTestCase
{

    public function testFirstExampleIsResolvedCorrectly()
    {
        $givenBinaryString = str_replace(' ', '', 'B F F F B B F R R R');
        $expectedRow = 70;
        $expectedCol = 7;
        $expectedSeatId = 567;
        /** @var FileReader $fileReader */
        $fileReader = $this->getMockBuilder(FileReader::class)->disableOriginalConstructor()
            ->getMock();
        $solver = new DayFiveSolver($fileReader);

        $seat = $solver->makeSeatFromBoardingPass($givenBinaryString);

        $this->assertEquals($expectedRow, $seat->getRow());

        $this->assertEquals($expectedCol, $seat->getColumn());

        $this->assertEquals($expectedSeatId, $seat->getSeatId());
    }

    public function testSecondExampleIsResolvedCorrectly()
    {
        $givenBinaryString = str_replace(' ', '', 'F F F B B B F R R R');
        $expectedRow = 14;
        $expectedCol = 7;
        $expectedSeatId = 119;
        /** @var FileReader $fileReader */
        $fileReader = $this->getMockBuilder(FileReader::class)->disableOriginalConstructor()
            ->getMock();
        $solver = new DayFiveSolver($fileReader);

        $seat = $solver->makeSeatFromBoardingPass($givenBinaryString);

        $this->assertEquals($expectedRow, $seat->getRow());

        $this->assertEquals($expectedCol, $seat->getColumn());

        $this->assertEquals($expectedSeatId, $seat->getSeatId());
    }

    public function testThirdExampleIsResolvedCorrectly()
    {
        $givenBinaryString = str_replace(' ', '', 'B B F F B B F R L L');
        $expectedRow = 102;
        $expectedCol = 4;
        $expectedSeatId = 820;

        /** @var FileReader $fileReader */
        $fileReader = $this->getMockBuilder(FileReader::class)->disableOriginalConstructor()
            ->getMock();

        $solver = new DayFiveSolver($fileReader);

        $seat = $solver->makeSeatFromBoardingPass($givenBinaryString);

        $this->assertEquals($expectedRow, $seat->getRow());

        $this->assertEquals($expectedCol, $seat->getColumn());

        $this->assertEquals($expectedSeatId, $seat->getSeatId());
    }

    protected function getSolverClass(): string
    {
        return DayFiveSolver::class;
    }
}