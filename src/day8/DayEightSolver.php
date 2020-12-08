<?php


namespace App\day8;


use App\AbstractSolver;

class DayEightSolver extends AbstractSolver
{

    /** @var bool $stepByStep */
    private bool $stepByStep = true;

    /** @var Opcode[]|array  */
    private array $program = [];

    public function solvePartOne(): string
    {
        $this->readProgramFile();
        $handheldSystem = new HandheldSystem($this->program);
        while ($handheldSystem->isSystemRunning()) {
            $handheldSystem->step();
        }

        if ($handheldSystem->hasExecutionFinishedWithoutErrors()) {
            return sprintf("Program finished. Accumulator is %s", $handheldSystem->getAccumulator());
        } else {
            return sprintf("Program has finished with errors: %s", $handheldSystem->getErrors());
        }

    }

    private function readProgramFile() {
        $program = $this->fileToArrayAsValue();
        foreach ($program as $programLine) {
            $values = preg_split('/\s/', $programLine);
            $this->program[] = new Opcode($values[0], $values[1]);
        }
    }

    public function solvePartTwo(): string
    {
        $handheldSystem = new HandheldSystem($this->program, true);
        $programMessage = '';

        $handheldSystem->run();

        return sprintf("Program has finished with accumulator %s", $handheldSystem->getAccumulator());
    }
}