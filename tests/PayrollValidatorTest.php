<?php
/**
 * Created by PhpStorm.
 * User: tomto
 * Date: 02/11/17
 * Time: 17:07
 */

use App\PayrollValidator;
use PHPUnit\Framework\TestCase;

class PayrollValidatorTest extends TestCase
{

    public function validYearStrings()
    {
        return [['2017'], ['1932'], ['1000'], ['9999']];
    }
    public function invalidYearStrings()
    {
        return [['22017'], ['193'], ['-299'], [''], ['a'], ['/n'], ['YYYY']];
    }

    /**
     * @dataProvider validYearStrings
     */
    public function testPassesValidYearString($year)
    {
        $dm = new \App\PayrollDateManager("2017");
        $this->assertTrue(PayrollValidator::year($year));
    }

    /**
     * @dataProvider invalidYearStrings
     */
    public function testFailsInvalidYearString($year)
    {
        $this->assertFalse(PayrollValidator::year($year));
    }

    public function validFilenameStrings() {
        return [
            ['filename'], ['filename1'], ['a'], ['1'], ['_'], ['_41za-']
        ];
    }

    /**
     * Data provider for invalid filenames
     * @return array
     */
    public function invalidFilenameStrings() {
        return [
            [''], ['-'], ['filename*'], ['filename/'], ['/filename'], ['abc?'], ['file name']
        ];
    }

    /**
     * @dataProvider validFilenameStrings
     */
    public function testPassesValidFilenameString($filename) {
        $this->assertTrue(PayrollValidator::filename($filename));
    }

    /**
     * @dataProvider invalidFilenameStrings
     */
    public function testFailsInvalidFilenameString($filename) {
        $this->assertFalse(PayrollValidator::filename($filename));
    }

}
