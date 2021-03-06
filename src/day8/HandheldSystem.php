<?php


namespace App\day8;


class HandheldSystem
{

    public const STATE_RUNNING = 1;

    public const STATE_FINISHED = 2;

    public const STATE_FINISHED_BY_LOOP_ERROR = 3;

    private int $programCounter = 0;

    private array $programCounterHistory = [];

    private array $jumpsChangedToNops = [];

    private array $nopsChangedToJumps = [];

    private int $accumulator = 0;

    /** @var Opcode[]|array  */
    private array $program = [];

    private int $state;

    private bool $loopedJumpPrevention;

    private bool $alreadyChangedExecution = false;

    /**
     * HandheldSystem constructor.
     * @param Opcode[]|array $program
     * @param bool $loopedJumpPrevention
     */
    public function __construct(array $program, bool $loopedJumpPrevention = false)
    {
        $this->loopedJumpPrevention = $loopedJumpPrevention;
        $this->jumpsChangedToNops = [];
        $this->nopsChangedToJumps = [];
        $this->reset($program);
    }

    /**
     * @param Opcode[]|array $program
     */
    public function reset(array $program) {
        $this->programCounter = 0;
        $this->programCounterHistory = [];
        $this->accumulator = 0;
        $this->state = static::STATE_RUNNING;
        $this->program = $program;
        $this->alreadyChangedExecution = false;
    }

    /**
     * @param bool $debug
     */
    public function run(bool $debug = false) {
        $executions = 1;
        do {
            if ($debug) {
                var_dump('Attempting execution: ' . $executions);
                var_dump('Nopped jumps at PC:  ' . json_encode($this->jumpsChangedToNops));
                var_dump('Jumped nops at PC:  ' . json_encode($this->nopsChangedToJumps));
            }
            $this->reset($this->program);
            while ($this->isSystemRunning()) {
                if ($debug) {
                    var_dump($this->step());
                } else {
                    $this->step();
                }
            }
            $executions++;
        } while (!$this->hasExecutionFinishedWithoutErrors());
    }

    /**
     * @return string
     */
    public function step(): string {
        if ($this->isSystemRunning()) {
            if (isset($this->program[$this->programCounter])) {
                if (!in_array($this->programCounter, $this->programCounterHistory)) {
                    $this->programCounterHistory[] = $this->programCounter;
                    return $this->doStep($this->program[$this->programCounter]);
                }
                $this->finishExecutionWithLoops();
                return sprintf("Attempted to execute an instruction that was already executed once. Did it with PC %s and accumulator %s", $this->programCounter, $this->accumulator);
            }
            $this->finishExecution();
            return sprintf("Accumulator %s", $this->accumulator);
        }

        return sprintf("Attempted to step once the program was already finished with PC %s and accumulator %s", $this->programCounter, $this->accumulator);
    }

    /**
     * @param Opcode $opcode
     * @return string
     */
    private function doStep(Opcode $opcode) {
        $modifier = $opcode->getModifier();
        if ($opcode->getInstruction() === Opcode::OPCODE_ACC) {
            return $this->doAcc($modifier);
        } elseif ($opcode->getInstruction() === Opcode::OPCODE_JMP) {
            return $this->doJmp($modifier);
        } elseif ($opcode->getInstruction() === Opcode::OPCODE_NOP) {
            return $this->doNop($modifier);
        }

        return sprintf('Unrecognized opcode at Program Counter %s with an ACC value of %s', $this->programCounter, $this->accumulator);
    }

    /**
     * @param int $modifier
     *
     * @return string
     */
    private function doJmp(int $modifier): string {

        if ($this->shouldAttemptToModify($modifier, $this->jumpsChangedToNops)) {
                $this->jumpsChangedToNops[] = $this->programCounter;
                $this->alreadyChangedExecution = true;
                return sprintf("Changed jump to %s", $this->doNop($modifier));
        }

        $this->programCounter += $modifier;

        return sprintf('Jumping to %s', $this->programCounter);
    }

    /**
     * @param int $modifier
     *
     * @return string
     */
    private function doNop(int $modifier): string {
        if ($this->shouldAttemptToModify($modifier, $this->nopsChangedToJumps)) {
            $this->nopsChangedToJumps[] = $this->programCounter;
            $this->alreadyChangedExecution = true;
            return sprintf("Changed nop to %s", $this->doJmp($modifier));
        }

        $this->programCounter++;

        return sprintf('Doing nothing');
    }

    /**
     * @param int $modifier
     * @param array $modifications
     *
     * @return bool
     */
    private function shouldAttemptToModify(int $modifier, array $modifications) {
        return ($modifier !== 0 &&
            !$this->alreadyChangedExecution && !in_array($this->programCounter, $modifications)
            && $this->loopedJumpPrevention);
    }

    /**
     * @param int $modifier
     *
     * @return string
     */
    private function doAcc(int $modifier): string {
        $this->accumulator += $modifier;
        $this->programCounter++;

        return sprintf('Accumulator is now %s at PC %s', $this->accumulator, $this->programCounter);
    }

    private function finishExecution(): void {
        $this->state = static::STATE_FINISHED;
    }

    private function finishExecutionWithLoops(): void {
        $this->state = static::STATE_FINISHED_BY_LOOP_ERROR;
    }

    /**
     * @return bool
     */
    public function isSystemRunning(): bool {
        return $this->state === static::STATE_RUNNING;
    }

    public function hasExecutionFinishedWithoutErrors(): bool {
        return $this->state === static::STATE_FINISHED;
    }

    public function getErrors(): string {
        if ($this->state === static::STATE_FINISHED_BY_LOOP_ERROR) {
            return sprintf("Program has run into repeated execution at PC %s with accumulator value %s", $this->programCounter, $this->accumulator);
        }

        return sprintf("Unknown error");
    }

    /**
     * @return int
     */
    public function getProgramCounter(): int
    {
        return $this->programCounter;
    }

    /**
     * @return int
     */
    public function getAccumulator(): int
    {
        return $this->accumulator;
    }
}