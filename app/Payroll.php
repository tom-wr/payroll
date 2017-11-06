<?php namespace App;

/**
 * Class Payroll
 * This class holds and manages a single yearly payroll array.
 * @package App
 */
class Payroll
{
    /**
     * @var PayrollMonth[] The payroll array of PayrollMonth objects
     */
    private $payrollArray;

    /**
     * Payroll constructor.
     */
    public function __construct()
    {
        $this->payrollArray = [12];
    }

    /**
     * Adds a PayrollMonth to the payroll array.
     * @param int $monthIndex The month index number (-1 due to array indexing).
     * @param string $monthString The month's name.
     * @param string $expensesDate1 The 1st expense date string.
     * @param string $expensesDate2 The second expense date string.
     * @param string $salaryDate The salary date string.
     */
    public function add(int $monthIndex, string $monthString, string $expensesDate1, string $expensesDate2, string $salaryDate)
    {
        // Create a new payroll month
        $payrollMonth = new PayrollMonth($monthString, $expensesDate1, $expensesDate2, $salaryDate);
        // Add the month to the corresponding index in the payroll array.
        $this->payrollArray[$monthIndex] = $payrollMonth;
    }

    /**
     * Returns the payroll months line by line.
     * @return string The payroll array as a line by line list of month data.
     */
    public function toString()
    {
        $output = '';
        foreach ($this->payrollArray as $month)
        {
            $output .= $month->toString() . PHP_EOL;
        }
        return $output;
    }

}