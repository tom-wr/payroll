<?php
/**
 * Created by PhpStorm.
 * User: tomto
 * Date: 06/11/17
 * Time: 17:49
 */

use App\PayrollManager;
use PHPUnit\Framework\TestCase;

class PayrollManagerTest extends TestCase
{

    private $expectedPayrollString;

    public function setUp()
    {
        $this->expectedPayrollString =
            '"January", "1999-01-01", "1999-01-15", "1999-01-29"' . PHP_EOL .
            '"February", "1999-02-01", "1999-02-15", "1999-02-26"' . PHP_EOL .
            '"March", "1999-03-01", "1999-03-15", "1999-03-31"' . PHP_EOL .
            '"April", "1999-04-01", "1999-04-15", "1999-04-30"' . PHP_EOL .
            '"May", "1999-05-03", "1999-05-17", "1999-05-31"' . PHP_EOL .
            '"June", "1999-06-01", "1999-06-15", "1999-06-30"' . PHP_EOL .
            '"July", "1999-07-01", "1999-07-15", "1999-07-30"' . PHP_EOL .
            '"August", "1999-08-02", "1999-08-16", "1999-08-31"' . PHP_EOL .
            '"September", "1999-09-01", "1999-09-15", "1999-09-30"' . PHP_EOL .
            '"October", "1999-10-01", "1999-10-15", "1999-10-29"' . PHP_EOL .
            '"November", "1999-11-01", "1999-11-15", "1999-11-30"' . PHP_EOL .
            '"December", "1999-12-01", "1999-12-15", "1999-12-31"' . PHP_EOL;
    }

    public function testCreatesAValidPayroll()
    {
        $dateManager = new \App\PayrollDateManager("1999");
        $payrollManager = new PayrollManager($dateManager);
        $payrollString = $payrollManager->getPayroll()->toString();

        $this->assertEquals($this->expectedPayrollString, $payrollString);

    }
}
