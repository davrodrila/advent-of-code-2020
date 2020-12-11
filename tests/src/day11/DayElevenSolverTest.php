<?php


namespace src\day11;


use App\day11\DayElevenSolver;
use App\File\FileReader;
use PHPUnit\Framework\TestCase;

class DayElevenSolverTest extends TestCase
{
    public function testFirstWebCasePermutationWorks() {
        /** @var FileReader $fileReader */
        $fileReader = $this->getMockBuilder(FileReader::class)->disableOriginalConstructor()->getMock();
        $fileReader->method('readFile')
            ->will($this->generate([
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
            ]
            ));

        $solver = new DayElevenSolver($fileReader);
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
        /** @var FileReader $fileReader */
        $fileReader = $this->getMockBuilder(FileReader::class)->disableOriginalConstructor()->getMock();
        $fileReader->method('readFile')
            ->will($this->generate([
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
                ]
            ));

        $solver = new DayElevenSolver($fileReader);

        $this->assertEquals(37, $solver->solvePartOne());
    }

    private function generate(array $values)
    {
        return $this->returnCallback(function() use ($values) {
            foreach ($values as $value) {
                yield $value;
            }
        });
    }
}