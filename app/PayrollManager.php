<?php namespace App;

/**
 * Class PayrollManager
 * Handles building the payroll using the data manager.
 *
 * @package App
 */
class PayrollManager
{
    /**
     * @var Payroll
     */
    private $payroll;

    /**
     * @var PayrollDateManager
     */
    private $dateManager;

    /**
     * PayrollManager constructor.
     * @param PayrollDateManager $dateManager
     */
    public function __construct(PayrollDateManager $dateManager)
    {
        $this->dateManager = $dateManager;
        $this->payroll = $this->build();
    }

    /**
     * Builds the payroll month by month.
     * @return Payroll
     */
    private function build()
    {
        $payroll = new Payroll();
        for($month = 1; $month <= 12; $month ++)
        {

            $monthText = $this->dateManager->monthString($month);
            $salaryDate = $this->dateManager->calculateSalaryDateForMonth($month);
            $expensesDate1 = $this->dateManager->calculateExpensesDate($month, 1);
            $expensesDate2 = $this->dateManager->calculateExpensesDate($month, 15);

            $payroll->add($month - 1, $monthText, $expensesDate1, $expensesDate2, $salaryDate);

        }
        return $payroll;
    }

    /**
     * @return Payroll
     */
    public function getPayroll()
    {
        return $this->payroll;
    }

}