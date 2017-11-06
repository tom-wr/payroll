<?php namespace App;
/**
 * Class PayrollValidator
 * Provides static validation functions for cli argument validation.
 * @package App
 */
class PayrollValidator
{
    /**
     * Makes a validity check on a year string.
     * @param string $year The year to be validated.
     * @return bool The validation result.
     */
    static public function year(string $year) : bool
    {
        // return true if year string length is 4 and every character in the string is a digit.
        if((strlen($year) === 4) && (ctype_digit($year))) {
            return true;
        } else {
            fwrite(STDOUT, "Validation Error: Year must be in numeric YYYY format." . PHP_EOL);
            return false;
        }
    }

    /**
     * Makes a validity check on a filename string.
     * The string must only contain a-z (case-insensitive), numerals, _ and -.
     * The string cannot start with a -
     * @param string $filename The filename to be validated.
     * @return bool The validation result.
     */
    static public function filename(string $filename) : bool
    {
        // regex for alphanumeric (upper and lowercase) underscores and hyphens
        $match = preg_match("/^[A-Za-z0-9_-]+$/", $filename);
        // pass if regex matches and first character is not a hyphen
        if($match && $filename[0] != '-') {
            return true;
        } else {
            fwrite(STDOUT, "Validation Error: Filename must only contain alphanumeric, '_' and '-' characters." . PHP_EOL);
            return false;
        }
    }
}