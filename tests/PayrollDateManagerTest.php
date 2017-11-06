<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\PayrollDateManager;

class PayrollDateManagerTest extends TestCase
{
    /**
     * Date provider for valid salary dates for a given year and month
     * @return array
     */
    public function validSalaryDates() {
        return [
            // year, month, day
            ['2000', '02', '29'],
            ['2001', '03', '30'],
            ['2017', '12', '29'],
            ['2018', '02', '28'],
            ['2019', '03', '29'],
            ['2020', '02', '28'],
            ['2021', '02', '26'],
            ['2022', '10', '31']
        ];
    }

    /**
     * Data provider for valid expenses dates for a given expenses day
     * @return array
     */
    public function validExpensesDates() {

        return [
            // expenses day, year, month, day
            [1, '2017', '12', '01'],
            [1, '2018', '04', '02'],
            [1, '2019', '06', '03'],
            [1, '2020', '05', '01'],
            [15, '2017', '12', '15'],
            [15, '2018', '04', '16'],
            [15, '2019', '06', '17'],
            [15, '2020', '05', '15']
        ];
    }


    /**
     * @param $year
     * @param $month
     * @param $day
     * @dataProvider validSalaryDates
     */
    public function testCalculatesCorrectSalaryDateForAGivenMonth($year, $month, $day)
    {
        $dateManager = new PayrollDateManager($year);
        $expectedSalaryDate = $year . '-' . $month . '-' . $day;
        $calculatedSalaryDate = $dateManager->calculateSalaryDateForMonth((int) $month);
        $this->assertEquals($expectedSalaryDate, $calculatedSalaryDate);
    }

    /**
     * @param $expensesDay
     * @param $year
     * @param $month
     * @param $day
     * @dataProvider validExpensesDates
     */
    public function testCalculatesCorrectExpensesDateForAGivenExpensesDay($expensesDay, $year, $month, $day)
    {
        $dateManager = new PayrollDateManager($year);
        $expectedExpensesDate = $year . '-' . $month . '-' . $day;
        $calculatedExpensesDate = $dateManager->calculateExpensesDate((int) $month, $expensesDay);
        $this->assertEquals($expectedExpensesDate, $calculatedExpensesDate);
    }

    public function validMonthStringsByDates()
    {
        return [
            ['2017', 'January', 1],
            ['2000', 'February', 2],
            ['2020', 'March', 3],
            ['2023', 'December', 12],
        ];
    }

    public function invalidMonthStringsByDates()
    {
        return [
            ['2017', 'January', 0],
            ['2000', 'February', 3],
            ['2020', 'March', -8],
            ['2023', 'December', 13],
        ];
    }

    /**
     * @dataProvider validMonthStringsByDates
     */
    public function testGetsCorrectMonthStringFromAGivenDate($year, $monthString, $month)
    {
        $dateManager = new PayrollDateManager($year);
        $this->assertEquals($monthString, $dateManager->monthString($month));
    }

    /**
     * @dataProvider invalidMonthStringsByDates
     */
    public function testFailsInvalidMonthStringFromAGivenDate($year, $monthString, $month)
    {
        $dateManager = new PayrollDateManager($year);
        $this->assertNotEquals($monthString, $dateManager->monthString($month));
    }
}
