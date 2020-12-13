<?php

namespace src\day12;

use App\day12\DayTwelveSolver;
use src\Model\BaseTestCase;

class DayTwelveSolverTest extends BaseTestCase
{
    public function testWebFirstCase()
    {
        $solver = $this->getDaySolverWithTestData(['F10','N3','F7','R90','F11']);

        $this->assertEquals(25, $solver->solvePartOne());
    }

    public function testWebSecondCase()
    {
        $solver = $this->getDaySolverWithTestData(['F10','N3','F7','R90','F11']);

        $this->assertEquals(286, $solver->solvePartTwo());
    }

    protected function getSolverClass(): string
    {
        return DayTwelveSolver::class;
    }
}
