<?php namespace App;

/**
 * Class PayrollFileManager
 * Handles writing the output file to the system.
 * @package App
 */
class PayrollFileManager
{
    /**
     * File extension for the output file.
     */
    const FILE_EXTENSION = '.txt';

    /**
     * @var string
     */
    private $outputFilename;

    /**
     * PayrollFileManager constructor.
     * @param string $outputFilename
     */
    function __construct(string $outputFilename)
    {
        $this->outputFilename = $outputFilename;
    }

    /**
     * Writes the payroll output string to file.
     * @param string $payrollOutput
     */
    public function write(string $payrollOutput)
    {
        $output = $this->fileHeaderView() . $payrollOutput;
        $file = $this->outputFilename . self::FILE_EXTENSION;
        file_put_contents($file, $output);
    }

    /**
     * Returns the output table header string.
     * @return string
     */
    private function fileHeaderView()
    {
        return '"Month Name", "1st Expenses Day", "2nd Expenses Day", "Salary Day"' . PHP_EOL;
    }
}