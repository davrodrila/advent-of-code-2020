<?php

namespace src\day9;

use App\day9\DayNineSolver;
use App\day9\XMAS;
use src\Model\BaseTestCase;

class XMASTest extends BaseTestCase
{

    public function testWebFirstCase()
    {
        $numbers = [ 35, 20, 15, 25, 47, 40, 62, 55, 65, 95, 102, 117, 150, 182, 127, 219, 299, 277, 309, 576 ];
        $preamble = 5;

        $xmas = new XMAS($preamble, $numbers);

        $number = $xmas->lookForInvalidNumber();

        $this->assertEquals(127, $number);

    }

    public function testWebSecondCase()
    {
        $numbers = [ 35, 20, 15, 25, 47, 40, 62, 55, 65, 95, 102, 117, 150, 182, 127, 219, 299, 277, 309, 576 ];
        $preamble = 5;

        $xmas = new XMAS($preamble, $numbers);

        $encryptionWeakness = $xmas->findEncryptionWeakness(127);

        $this->assertEquals(62, $encryptionWeakness);
    }

    protected function getSolverClass(): string
    {
        return DayNineSolver::class;
    }
}