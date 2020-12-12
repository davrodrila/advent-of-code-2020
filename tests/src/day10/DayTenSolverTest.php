<?php

namespace src\day10;

use App\day10\DayTenSolver;
use src\Model\BaseTestCase;


class DayTenSolverTest extends BaseTestCase
{
    public function testWebFirstCase()
    {
        $solver = $this->getDaySolverWithTestData([16,10,15,5,1,11,7,19,6,12,4]);

        $this->assertEquals(35, $solver->solvePartOne());
    }

    public function testWebSecondCase()
    {
        $solver = $this->getDaySolverWithTestData([28,33,18,42,31,14,46,20,48,47,24,23,49,45,19,38,39,11,1,32,25,35,8,17,7,9,4,2,34,10, 3]);

        $this->assertEquals(220, $solver->solvePartOne());
    }

    protected function getSolverClass(): string
    {
        return DayTenSolver::class;
    }
}