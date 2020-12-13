<?php


namespace day13;


use App\day13\DayThirteenSolver;
use src\Model\BaseTestCase;

class DayThirteenSolverTest extends BaseTestCase
{

    public function testWebFirstCase() {
        $solver = $this->getDaySolverWithTestData([939, "7,13,x,x,59,x,31,19"]);

        $this->assertEquals(295, $solver->solvePartOne());
    }

    protected function getSolverClass(): string
    {
        return DayThirteenSolver::class;
    }
}