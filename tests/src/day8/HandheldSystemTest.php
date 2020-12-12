<?php

namespace src\day8;

use App\day8\DayEightSolver;
use App\day8\HandheldSystem;
use App\day8\Opcode;
use src\Model\BaseTestCase;

class HandheldSystemTest extends BaseTestCase
{

    /**
     * nop +0
    acc +1
    jmp +4
    acc +3
    jmp -3
    acc -99
    acc +1
    jmp -4
    acc +6
     */
    public function testWebInput() {
        $program[] = new Opcode('nop', 0); //0x0 acc is 0, pc goes from 0 to 1 (1)
        $program[] = new Opcode('acc', 1); //0x1 acc is 1, pc goes from 1 to 2 (2)
        $program[] = new Opcode('jmp', +4); //0x2 acc is 1, pc goes from 2 to 6 (3)
        $program[] = new Opcode('acc', 3); //0x3 acc is 5, pc goes from 3 to 4 (6)
        $program[] = new Opcode('jmp', -3); //0x4 acc is 5, pc goes from 4 to 1 (7)
        $program[] = new Opcode('acc', -99); //0x5 acc is -100, pc is
        $program[] = new Opcode('acc', 1); //0x6 acc is 2, pc goes from 6 to 7 (4)
        $program[] = new Opcode('jmp', -4); // 0x7 acc is 2, pc goes from 7 to 3 (5)
        $program[] = new Opcode('acc', 6); // 0x8

        $handheldSystem = new HandheldSystem($program);
        while ($handheldSystem->isSystemRunning()) {
            $handheldSystem->step();
        }

        $this->assertEquals(5, $handheldSystem->getAccumulator());
    }

    public function testJumpPrevention() {
        $program[] = new Opcode('nop', 0);  //0x0 acc is 0, pc goes from 0 to 1 (1)
        $program[] = new Opcode('acc', 1); //0x1 acc is 1, pc goes from 1 to 2 (2)
        $program[] = new Opcode('jmp', +4);  //0x2 acc is 1, pc goes from 2 to 6 (3)
        $program[] = new Opcode('acc', 3); //0x3 acc is 5, pc goes from 3 to 4 (6)
        $program[] = new Opcode('jmp', -3);  //0x4 acc is 5, pc goes from 4 to 1 (7)
        $program[] = new Opcode('acc', -99); ; //0x5 acc is -100, dead code
        $program[] = new Opcode('acc', 1);  //0x6 acc is 2, pc goes from 6 to 7 (4)
        $program[] = new Opcode('jmp', -4);  // 0x7 acc is 2, pc goes from 7 to 3 (5)
        $program[] = new Opcode('acc', 6); // 0x8

        $handheldSystem = new HandheldSystem($program, true);
        $handheldSystem->run();

        $this->assertEquals(8, $handheldSystem->getAccumulator());
    }

    protected function getSolverClass(): string
    {
        return DayEightSolver::class;
    }
}
