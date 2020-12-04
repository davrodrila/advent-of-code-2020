<?php


namespace App\day4;


class ChallengeValues
{
    public const BIRTH_YEAR_KEY = 'byr';

    public const BIRTH_YEAR_START = 1920 ;

    public const BIRTH_YEAR_END = 2002;

    public const ISSUE_YEAR_KEY = 'iyr';

    public const ISSUE_YEAR_START = 2010;

    public const ISSUE_YEAR_END = 2020;

    public const EXPIRATION_YEAR_KEY = 'eyr';

    public const EXPIRATION_YEAR_START = 2020;

    public const EXPIRATION_YEAR_END = 2030;

    public const HEIGHT_KEY = 'hgt';

    public const CM_MIN_HEIGHT = 150;

    public const CM_MAX_HEIGHT = 193;

    public const IN_MIN_HEIGHT = 59;

    public const IN_MAX_HEIGHT = 76;

    public const HAIR_COLOR_KEY = 'hcl';

    public const EYE_COLOR_KEY = 'ecl';

    public const VALID_EYE_COLORS = ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'];

    public const PASSPORT_ID_KEY = 'pid';

    public const COUNTRY_ID_KEY = 'cid';

    public const PASSPORT_DATA_SEPARATOR_REGEX = '/\\s/';

    public const PASSPORT_KEY_VALUE_SEPARATOR_REGEX = '/:/';

    public const HEX_VALUE_REGEX = '/[0-9a-f]+/i';

    public const PASSPORT_KEY = 0;

    public const PASSPORT_VALUE = 1;

    public const CENTIMETER_STRING = 'cm';

    public const HEX_STARTING_VALUE = '#';

    public const INCHES_STRING = 'in';
}