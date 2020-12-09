<?php


namespace src\day9;


use App\day9\XMAS;
use PHPUnit\Framework\TestCase;

class XMASTest extends TestCase
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
}