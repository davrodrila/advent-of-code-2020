<?php


namespace App\day4;


class Passport
{
    /** @var string|null $birthYear */
    private ?string $birthYear;

    /** @var string|null $issueYear */
    private ?string $issueYear;

    /** @var string|null $expirationYear */
    private ?string $expirationYear;

    /** @var string|null $height */
    private ?string $height;

    /** @var string|null $hairColor */
    private ?string $hairColor;

    /** @var string|null $eyeColor */
    private ?string $eyeColor;

    /** @var string|null $passportId */
    private ?string $passportId;

    /** @var string|null $countryId */
    private ?string $countryId;

    /**
     * Passport constructor.
     * @param string|null $birthYear
     * @param string|null $issueYear
     * @param string|null $expirationYear
     * @param string|null $height
     * @param string|null $hairColor
     * @param string|null $eyeColor
     * @param string|null $passportId
     * @param string|null $countryId
     */
    public function __construct(
        ?string $birthYear,
        ?string $issueYear,
        ?string $expirationYear,
        ?string $height,
        ?string $hairColor,
        ?string $eyeColor,
        ?string $passportId,
        ?string $countryId
    ) {
        $this->birthYear = $birthYear;
        $this->issueYear = $issueYear;
        $this->expirationYear = $expirationYear;
        $this->height = $height;
        $this->hairColor = $hairColor;
        $this->eyeColor = $eyeColor;
        $this->passportId = $passportId;
        $this->countryId = $countryId;
    }

    /**
     * @return string|null
     */
    public function getBirthYear(): ?string
    {
        return $this->birthYear;
    }

    /**
     * @param string|null $birthYear
     */
    public function setBirthYear(?string $birthYear): void
    {
        $this->birthYear = $birthYear;
    }

    /**
     * @return string|null
     */
    public function getIssueYear(): ?string
    {
        return $this->issueYear;
    }

    /**
     * @param string|null $issueYear
     */
    public function setIssueYear(?string $issueYear): void
    {
        $this->issueYear = $issueYear;
    }

    /**
     * @return string|null
     */
    public function getExpirationYear(): ?string
    {
        return $this->expirationYear;
    }

    /**
     * @param string|null $expirationYear
     */
    public function setExpirationYear(?string $expirationYear): void
    {
        $this->expirationYear = $expirationYear;
    }

    /**
     * @return string|null
     */
    public function getHeight(): ?string
    {
        return $this->height;
    }

    /**
     * @param string|null $height
     */
    public function setHeight(?string $height): void
    {
        $this->height = $height;
    }

    /**
     * @return string|null
     */
    public function getHairColor(): ?string
    {
        return $this->hairColor;
    }

    /**
     * @param string|null $hairColor
     */
    public function setHairColor(?string $hairColor): void
    {
        $this->hairColor = $hairColor;
    }

    /**
     * @return string|null
     */
    public function getEyeColor(): ?string
    {
        return $this->eyeColor;
    }

    /**
     * @param string|null $eyeColor
     */
    public function setEyeColor(?string $eyeColor): void
    {
        $this->eyeColor = $eyeColor;
    }

    /**
     * @return string|null
     */
    public function getPassportId(): ?string
    {
        return $this->passportId;
    }

    /**
     * @param string|null $passportId
     */
    public function setPassportId(?string $passportId): void
    {
        $this->passportId = $passportId;
    }

    /**
     * @return string|null
     */
    public function getCountryId(): ?string
    {
        return $this->countryId;
    }

    /**
     * @param string|null $countryId
     */
    public function setCountryId(?string $countryId): void
    {
        $this->countryId = $countryId;
    }

    /**
     * @return bool
     */
    public function isComplete(): bool {
        return ($this->birthYear && $this->issueYear && $this->expirationYear && $this->height &&
            $this->hairColor && $this->eyeColor && $this->passportId);
    }

    /**
     * @return bool
     */
    public function isValid(): bool {
        return ($this->isBirthYearValid() && $this->isIssuedYearValid() && $this->isExpirationYearValid() &&
            $this->isHeightValid() && $this->isHairColorValid() && $this->isEyeColorValid() && $this->isPassportIdValid());
    }

    /**
     * @return bool
     */
    private function isBirthYearValid(): bool {
         return ($this->birthYear && $this->birthYear >= ChallengeValues::BIRTH_YEAR_START && $this->birthYear <= ChallengeValues::BIRTH_YEAR_END);
    }

    /**
     * @return bool
     */
    private function isIssuedYearValid(): bool {
        return ($this->issueYear && $this->issueYear >= ChallengeValues::ISSUE_YEAR_START && $this->issueYear <= ChallengeValues::ISSUE_YEAR_END);
    }

    /**
     * @return bool
     */
    private function isExpirationYearValid(): bool {
        return ($this->expirationYear && $this->expirationYear >= ChallengeValues::EXPIRATION_YEAR_START && $this->expirationYear <= ChallengeValues::EXPIRATION_YEAR_END);
    }

    /**
     * @return bool
     */
    private function isHeightValid(): bool {
        if ($this->height) {
            if (strpos($this->height, ChallengeValues::CENTIMETER_STRING) !== false) {
               $result = str_replace(ChallengeValues::CENTIMETER_STRING, '', $this->height);
               if ($result >=ChallengeValues::CM_MIN_HEIGHT && $result <= ChallengeValues::CM_MAX_HEIGHT) {
                   return true;
               }
            }
            if (strpos($this->height, ChallengeValues::INCHES_STRING) !== false) {
                $result = str_replace(ChallengeValues::CENTIMETER_STRING, '', $this->height);
                if ($result >= ChallengeValues::IN_MIN_HEIGHT && $result <= ChallengeValues::IN_MAX_HEIGHT) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    private function isHairColorValid(): bool {
        if ($this->hairColor) {
            if ($this->hairColor[0] === ChallengeValues::HEX_STARTING_VALUE) {
                $color = substr($this->hairColor, 2);
                if (preg_match(ChallengeValues::HEX_VALUE_REGEX, $color)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    private function isEyeColorValid(): bool {
        if ($this->eyeColor) {
            if (in_array($this->eyeColor, ChallengeValues::VALID_EYE_COLORS)) {
                return true;
            }
        }

        return false;
    }
    /**
     * @return bool
     */
    private function isPassportIdValid(): bool {
        return ($this->passportId && (strlen($this->passportId) === ChallengeValues::PASSPORT_ID_LENGTH));
    }

}