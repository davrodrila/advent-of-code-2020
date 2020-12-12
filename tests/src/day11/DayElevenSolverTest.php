<?php

namespace src\day11;

use App\day11\DayElevenSolver;
use src\Model\BaseTestCase;

class DayElevenSolverTest extends BaseTestCase
{
    public function testFirstWebCasePermutationWorks() {
        /** @var DayElevenSolver $solver */
        $solver = $this->getDaySolverWithTestData([
              'L.LL.LL.LL',
              'LLLLLLL.LL',
              'L.L.L..L..',
              'LLLL.LL.LL',
              'L.LL.LL.LL',
              'L.LLLLL.LL',
              '..L.L.....',
              'LLLLLLLLLL',
              'L.LLLLLL.L',
              'L.LLLLL.LL',
        ]);

        $ferry = $solver->getFerry();
        $ferry->arrangeSeats();
        $firstPermutation =
            '#.##.##.##' . PHP_EOL .
            '#######.##' . PHP_EOL .
            '#.#.#..#..' . PHP_EOL .
            '####.##.##' . PHP_EOL .
            '#.##.##.##' . PHP_EOL .
            '#.#####.##' . PHP_EOL .
            '..#.#.....' . PHP_EOL .
            '##########' . PHP_EOL .
            '#.######.#' . PHP_EOL .
            '#.#####.##' . PHP_EOL;

        $this->assertEquals($firstPermutation, $ferry->print());
    }

    public function testFirstWebCaseGetsRightAmountOfOccupiedSeats() {
        $solver = $this->getDaySolverWithTestData([
              'L.LL.LL.LL',
              'LLLLLLL.LL',
              'L.L.L..L..',
              'LLLL.LL.LL',
              'L.LL.LL.LL',
              'L.LLLLL.LL',
              '..L.L.....',
              'LLLLLLLLLL',
              'L.LLLLLL.L',
              'L.LLLLL.LL',
        ]);

        $this->assertEquals(37, $solver->solvePartOne());
    }


    protected function getSolverClass(): string
    {
        return DayElevenSolver::class;
    }
}