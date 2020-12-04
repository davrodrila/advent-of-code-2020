<?php


namespace App\day4;


use App\AbstractSolver;

class DayFourSolver extends AbstractSolver
{

    /** @var Passport[]|array $passports */
    private array $passports = [];

    /**
     * @return string
     */
    public function solvePartOne(): string
    {
        if (!$this->passports) {
            $this->passports = $this->buildPassports();
        }
        $completePassports = [];
        $incompletePassports = [];
        foreach ($this->passports as $passport) {
            if ($passport->isComplete()) {
                $completePassports[] = $passport;
            } else {
                $incompletePassports[] = $passport;
            }
        }

        return sprintf("%s complete, %s uncompleted",count($completePassports), count($incompletePassports));
    }

    /**
     * @return string
     */
    public function solvePartTwo(): string
    {
        if (!$this->passports) {
            $this->passports = $this->buildPassports();
        }
        $validPassports = [];
        $invalidPassports = [];
        foreach ($this->passports as $passport) {
            if ($passport->isValid()) {
                $validPassports[] = $passport;
            } else {
                $invalidPassports[] = $passport;
            }
        }

        return sprintf("%s valid, %s invalid",count($validPassports), count($invalidPassports));
    }

    /**
     * @return array
     */
    private function buildPassports(): array
    {
        $passports = [];
        $rawData = [];
        foreach ($this->fileReader->readFile() as $line) {
            if (strlen($line) > 0) {
                $rawData[] = $line;
            } else {
                $this->processRawData($rawData, $passports);
                $rawData = [];
            }
        }

        # Remember to process the data for the current rawData block!
        # Otherwise you will be missing one passport structure
        $this->processRawData($rawData, $passports);

        return $passports;
    }

    /**
     * @param array $rawData
     * @param array &$passports
     */
    private function processRawData(array $rawData, array &$passports)
    {
        if (count($rawData) > 0) {
            $createdPassport = $this->readPassportStructures($rawData);
            $passports[] = $createdPassport;
        }
    }

    /**
     * @return string[]
     */
    private function initializePassportArray(): array {
        return [
            ChallengeValues::BIRTH_YEAR_KEY => null,
            ChallengeValues::COUNTRY_ID_KEY => null,
            ChallengeValues::EXPIRATION_YEAR_KEY => null,
            ChallengeValues::EYE_COLOR_KEY => null,
            ChallengeValues::ISSUE_YEAR_KEY => null,
            ChallengeValues::HAIR_COLOR_KEY => null,
            ChallengeValues::PASSPORT_ID_KEY => null,
            ChallengeValues::HEIGHT_KEY => null,
        ];
    }

    /**
     * @param array $rawData
     * @return Passport
     */
    private function readPassportStructures(array $rawData): Passport
    {
        $passportData = $this->initializePassportArray();
        foreach ($rawData as $data) {
            $structures = preg_split(ChallengeValues::PASSPORT_DATA_SEPARATOR_REGEX, $data);
            foreach ($structures as $structure) {
                $passportValues = preg_split(ChallengeValues::PASSPORT_KEY_VALUE_SEPARATOR_REGEX, $structure);
                $passportData[$passportValues[ChallengeValues::PASSPORT_KEY]] = $passportValues[ChallengeValues::PASSPORT_VALUE];
            }
        }

        return new Passport(
            $passportData[ChallengeValues::BIRTH_YEAR_KEY],
            $passportData[ChallengeValues::ISSUE_YEAR_KEY],
            $passportData[ChallengeValues::EXPIRATION_YEAR_KEY],
            $passportData[ChallengeValues::HEIGHT_KEY],
            $passportData[ChallengeValues::HAIR_COLOR_KEY],
            $passportData[ChallengeValues::EYE_COLOR_KEY],
            $passportData[ChallengeValues::PASSPORT_ID_KEY],
            $passportData[ChallengeValues::COUNTRY_ID_KEY]
        );
    }
}