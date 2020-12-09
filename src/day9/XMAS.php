<?php


namespace App\day9;


class XMAS
{

    private int $preamble;

    private int $queueStartingPoint = 0;

    private int $currentPosition = 0;

    private array $numbers = [];

    private array $queuedNumbers = [];

    /**
     * XMAS constructor.
     * @param int $preamble
     * @param array $numbers
     */
    public function __construct(int $preamble, array $numbers)
    {
        $this->preamble = $preamble;
        $this->numbers = $numbers;
        $this->currentPosition = $this->queueStartingPoint + $this->preamble;
    }

    /**
     * @return bool
     */
    private function isCurrentNumberValid(): bool
    {
        $number = $this->numbers[$this->currentPosition];
        $this->updateQueue();
        foreach ($this->queuedNumbers as $candidateNumber => $value) {
            foreach ($this->queuedNumbers as $secondCandidateNumber => $secondValue) {
                if (intval($candidateNumber) + intval($secondCandidateNumber) === $number) {
                    $this->currentPosition++;
                    return true;
                }
            }
        }
        $this->currentPosition++;
        return false;
    }

    /**
     * @return int
     */
    public function lookForInvalidNumber(): int
    {
        for ($i=$this->currentPosition; $i<count($this->numbers);$i++) {
            if (!$this->isCurrentNumberValid()) {
                return $this->numbers[$i];
            }
        }

        return -1;
    }

    private function updateQueue(): void
    {
        $this->queuedNumbers = [];
        for ($i=$this->queueStartingPoint; $i<($this->preamble+$this->queueStartingPoint); $i++) {
            $this->queuedNumbers[$this->numbers[$i]] = '';
        }

        $this->queueStartingPoint++;
    }

    public function findEncryptionWeakness(int $invalidNumber): int
    {
        $candidateNumbers = $this->loopThroughNumbersToGetCandidates($invalidNumber);
        if ($candidateNumbers) {
            return (min($candidateNumbers) + max($candidateNumbers));
        } else {
            return -1;
        }

    }

    public function loopThroughNumbersToGetCandidates(int $invalidNumber): ?array
    {
        for ($i=0;$i<count($this->numbers); $i++) {
            $candidateNumbers = [];
            for ($j=($i+1);$j<count($this->numbers); $j++) {
                $candidateNumbers[] = $this->numbers[$j];
                if (array_sum($candidateNumbers) === $invalidNumber) {
                    return $candidateNumbers;
                } elseif (array_sum($candidateNumbers) > $invalidNumber) {
                    break;
                }
            }
        }

        return null;
    }
}