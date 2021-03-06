<?php namespace App;
/**
 * Class PayrollMonth
 * Holds a payroll month's data.
 * @package App
 */
class PayrollMonth
{
    /**
     * @var string The name of the month.
     */
    private $monthName;

    /**
     * @var string The date for the 1st expenses day.
     */
    private $expensesDate1;

    /**
     * @var string The date for the 2nd expenses day.
     */
    private $expensesDate2;

    /**
     * @var string The date for the salary day.
     */
    private $salaryDate;

    /**
     * PayrollMonth constructor.
     * @param string $monthName The month's name.
     * @param string $expensesDate1 The 1st expense date string.
     * @param string $expensesDate2 The 2nd expense date string.
     * @param string $salaryDate The salary date string.
     */
    public function __construct(string $monthName, string $expensesDate1, string $expensesDate2, string $salaryDate)
    {
        $this->monthName = $monthName;
        $this->expensesDate1 = $expensesDate1;
        $this->expensesDate2 = $expensesDate2;
        $this->salaryDate = $salaryDate;
    }

    /**
     * @return string Gets the month's name.
     */
    public function getMonthName(): string
    {
        return $this->monthName;
    }

    /**
     * @return string Gets the 1st expenses date.
     */
    public function getExpensesDate1(): string
    {
        return $this->expensesDate1;
    }

    /**
     * @return string Gets the 2nd expenses date.
     */
    public function getExpensesDate2(): string
    {
        return $this->expensesDate2;
    }

    /**
     * @return string Gets the salary date.
     */
    public function getSalaryDate(): string
    {
        return $this->salaryDate;
    }

    /**
     * @return string The payroll month string.
     */
    public function toString(): string
    {
        return '"' . $this->monthName .'", "' . $this->expensesDate1 . '", "' . $this->expensesDate2 . '", "' . $this->salaryDate .'"';
    }

}