<?php namespace App;

/**
 * Class PayrollDateManager
 * Handles date calculations for a given year.
 * @package App
 */
class PayrollDateManager
{
    /**
     * @var int The year on which operations are enacted.
     */
    private $year;

    /**
     * PayrollDateManager constructor.
     * @param string $year THe year on which operations are enacted.
     */
    public function __construct(string $year)
    {
        $this->year = (int)$year;
    }

    /**
     * Calculates the salary date for a given month.
     * The salary date should be the last day of the month.
     * If the date falls on a weekend the date is offset to the previous Friday.
     * @param int $month The month's index i.e. 1 refers to January
     * @return string The date calculated for the salary day.
     */
    public function calculateSalaryDateForMonth(int $month): string
    {
        // Set the initial month date
        $initialDate = $this->formatDate($this->year, $month, 1);
        // Get last date of the month
        $salaryDate = date('Y-m-t', strtotime($initialDate));
        // Get the weekday the last day of the month falls on
        $weekday = date('l', strtotime($salaryDate));

        // If the weekday is a weekend offset the salary day accordingly
        if ($weekday === 'Sunday') {
            $salaryDate = date('Y-m-d', strtotime($salaryDate . '-2 day'));
        } else if ($weekday === 'Saturday') {
            $salaryDate = date('Y-m-d', strtotime($salaryDate . '-1 day'));
        }
        return $salaryDate;
    }

    /**
     * Calculates the expenses day for a given month and expenses day.
     * If the day falls on a weekend the date is offset to the following monday.
     * @param int $month The month's index i.e. 1 refers to January.
     * @param int $day The day of the month the expenses should be paid.
     * @return string The calculated date for the given expenses day.
     */
    public function calculateExpensesDate(int $month, int $day): string
    {
        // Set the initial expenses date
        $initialDate = $this->formatDate($this->year, $month, $day);
        $expensesDate = date('Y-m-d', strtotime($initialDate));
        // Get the weekday the expenses date falls upon
        $weekday = date('l', strtotime($expensesDate));

        // If the weekday is a weekend the expenses date is offset to fall on the following monday.
        if ($weekday === 'Sunday') {
            $expensesDate = date('Y-m-d', strtotime($expensesDate . '+1 day'));
        } else if ($weekday === 'Saturday') {
            $expensesDate = date('Y-m-d', strtotime($expensesDate . '+2 day'));
        }
        return $expensesDate;
    }

    /**
     * Creates a formatted date string.
     * @param $year string|int The year.
     * @param $month string|int The month.
     * @param $day string|int The day.
     * @return string string|int The formatted date string.
     */
    private function formatDate($year, $month, $day)
    {
        return $year . '-' . $month . '-' . $day;
    }

    /**
     * Transforms a month index into a month string. i.e turns 3 into 'March'.
     * @param int $month The month index to be calculated.
     * @return string The month string
     */
    public function monthString(int $month) {
        return date('F', strtotime($this->formatDate($this->year, $month, 1)));
    }

}