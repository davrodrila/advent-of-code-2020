<?php


namespace App\day8;


class Opcode
{

    public const OPCODE_JMP = 'jmp';

    public const OPCODE_NOP = 'nop';
    
    public const OPCODE_ACC = 'acc';
    
    private string $instruction;
    
    private int $modifier;

    /**
     * Opcode constructor.
     * @param string $instruction
     * @param int $modifier
     */
    public function __construct(string $instruction, int $modifier)
    {
        $this->instruction = $instruction;
        $this->modifier = $modifier;
    }

    /**
     * @return string
     */
    public function getInstruction(): string
    {
        return $this->instruction;
    }

    /**
     * @return int
     */
    public function getModifier(): int
    {
        return $this->modifier;
    }
}