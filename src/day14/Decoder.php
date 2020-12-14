<?php


namespace App\day14;


class Decoder
{
    public const V1 = 1;

    public const V2 = 2;

    private int $version;

    private string $mask;

    private array $memory;

    private const FLOATING_VALUES = [0 , 1];

    /**
     * Decoder constructor.
     * @param int $version
     */
    public function __construct(int $version)
    {
        $this->version = $version;
    }


    public function setCurrentMask(string $mask)
    {
        $this->mask = $mask;
    }


    public function processNumber(int $index, string $value)
    {
        if ($this->version === static::V1) {
            $binNumber = $this->fillWithZeroes($value);

            $number = $this->applyMask($binNumber);

            $this->memory[$index] = $number;
        } else {
            $this->processNumberV2($index, $value);
        }
    }

    public function getMemorySum(): int {
        if ($this->version === static::V1) {
            return array_sum($this->memory);
        } else {
            $sum = 0;
            foreach ($this->memory as $memory) {
                $sum += array_sum($memory);
            }

            return $sum;
        }
    }

    public function processNumberV2(int $index, string $value)
    {
        $binNumber = $this->fillWithZeroes($value);

        $number = $this->applyFloatingMask($binNumber);

        $this->memory[$index] = $number;
    }

    private function applyFloatingMask(string $binNumber): array
    {
        $partiallyAppliedMask = $binNumber;
        for ($i=0;$i<strlen($this->mask); $i++) {
            if ($this->mask[$i] === '1' ||$this->mask[$i] === 'X') {
                $partiallyAppliedMask[$i] = $this->mask[$i];
            }
        }

        $floatingNumbers = [];
        $alteredBits = [];

        for ($i=0;$i<strlen($partiallyAppliedMask); $i++) {
            if ($partiallyAppliedMask[$i] === 'X') {

                if (!in_array($i, $alteredBits)) {
                    $alteredBits[] = $i;
                    foreach ($alteredBits as $bit) {

                            $floatingValue = $partiallyAppliedMask;
                            $floatingValue[$bit] = $value;
                            $floatingNumbers[] = $floatingValue;
                        }
                    }
                }
            }
        }

        return $floatingNumbers;
    }

    private function fillWithZeroes(string $value): string
    {
        $value = decbin($value);
        if (strlen($value) < strlen($this->mask)) {
            $addedZeroes = strlen($this->mask) - strlen($value);
            $value = str_repeat('0', $addedZeroes) . $value ;
        }

        return $value;
    }

    private function applyMask(string $number): int
    {
        for ($i=0;$i<strlen($this->mask); $i++) {
            if ($this->mask[$i] !== 'X') {
                $number[$i] = $this->mask[$i];
            }
        }
        return bindec($number);
    }

}