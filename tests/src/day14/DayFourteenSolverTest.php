<?php


namespace day14;


use App\day14\DayFourteenSolver;
use src\Model\BaseTestCase;

class DayFourteenSolverTest extends BaseTestCase
{
    protected function getSolverClass(): string
    {
        return DayFourteenSolver::class;
    }

    public function testFirstWebTestCase()
    {
        $solver = $this->getDaySolverWithTestData(
            [
                'mask = XXXXXXXXXXXXXXXXXXXXXXXXXXXXX1XXXX0X',
                'mem[8] = 11',
                'mem[7] = 101',
                'mem[8] = 0'
            ]
        );

        $this->assertEquals(165,$solver->solvePartOne());
    }

    public function testSecondWebTestCase()
    {
        $solver = $this->getDaySolverWithTestData([
           'mask = 000000000000000000000000000000X1001X',
           'mem[42] = 100',
           'mask = 00000000000000000000000000000000X0XX',
           'mem[26] = 1'
        ]);

        $this->assertEquals(208, $solver->solvePartTwo());
    }
}