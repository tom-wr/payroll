<?php namespace App;

/**
 * Class PayrollApp
 * Handles management of payroll generation and file output.
 * @package App
 */
class PayrollApp
{
    /**
     * @var PayrollFileManager The file manager dependency.
     */
    private $fileManager;

    /**
     * @var PayrollManager The payroll manager dependency.
     */
    private $payrollManager;

    /**
     * PayrollApp constructor.
     * @param PayrollManager $payrollManager The payroll manager dependency.
     * @param PayrollFileManager $fileManager The file manager dependency.
     */
    public function __construct(PayrollManager $payrollManager, PayrollFileManager $fileManager)
    {
        $this->payrollManager = $payrollManager;
        $this->fileManager = $fileManager;
    }

    /**
     * Run the app. Get the payroll and write to file.
     */
    public function run()
    {
        // Get the payroll
        $payroll = $this->payrollManager->getPayroll();
        // Write the payroll output string to file
        $this->fileManager->write($payroll->toString());

    }
}