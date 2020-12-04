<?php

namespace App\day2;

class Password
{
    /** @var string $minAppearances */
    private string $minAppearances;

    /** @var string $maxAppearances */
    private string $maxAppearances;

    /** @var string $recurringString */
    private string $recurringString;

    /** @var string $password */
    private string $password;

    /**
     * Password constructor.
     * @param string $minAppearances
     * @param string $maxAppearances
     * @param string $recurringString
     * @param string $password
     */
    public function __construct(string $minAppearances, string $maxAppearances, string $recurringString, string $password)
    {
        $this->minAppearances = $minAppearances;
        $this->maxAppearances = $maxAppearances;
        $this->recurringString = $recurringString;
        $this->password = $password;
    }


    /**
     * @return string
     */
    public function getMinAppearances(): string
    {
        return $this->minAppearances;
    }

    /**
     * @param string $minAppearances
     */
    public function setMinAppearances(string $minAppearances): void
    {
        $this->minAppearances = $minAppearances;
    }

    /**
     * @return string
     */
    public function getMaxAppearances(): string
    {
        return $this->maxAppearances;
    }

    /**
     * @param string $maxAppearances
     */
    public function setMaxAppearances(string $maxAppearances): void
    {
        $this->maxAppearances = $maxAppearances;
    }

    /**
     * @return string
     */
    public function getRecurringString(): string
    {
        return $this->recurringString;
    }

    /**
     * @param string $recurringString
     */
    public function setRecurringString(string $recurringString): void
    {
        $this->recurringString = $recurringString;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return bool
     */
    public function isPartOneValid(): bool {
        $appearances = substr_count($this->password, $this->getRecurringString());
        return ($appearances >= $this->minAppearances && $appearances <= $this->maxAppearances);
    }

    /**
     * @return bool
     */
    public function isPartTwoValid(): bool {
        $fixedFirstPosition = intval($this->minAppearances)-1;
        $fixedSecondPosition = intval($this->maxAppearances)-1;
        $firstAppearance = isset($this->password[$fixedFirstPosition]) && $this->password[$fixedFirstPosition] === $this->recurringString;
        $secondAppearance = isset($this->password[$fixedSecondPosition]) && $this->password[$fixedSecondPosition] === $this->recurringString;

        if ($firstAppearance && $secondAppearance) {
            return false;
        }
        return ($firstAppearance || $secondAppearance);
    }

}