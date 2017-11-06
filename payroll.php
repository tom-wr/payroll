<?php

    require 'vendor/autoload.php';

    use App\PayrollApp;
    use App\PayrollValidator;
    use App\PayrollFileManager;
    use App\PayrollDateManager;
    use App\PayrollManager;

    /**
     *  Entry file for the Payroll calculator application.
     *  Tests cli input for validation and then starts the app.
     */

    // Exit the app instantly if the argument count is not correct
    if($argc != 3) {
        fwrite(STDOUT, "Command must be in the format: payroll.php [year] [output_filename]". PHP_EOL);
        exit();
    }
    // Assign cli arguments to variables
    $year = $argv[1];
    $outputFilename = $argv[2];

    // If the year and filename strings are valid start the app, else print an error message and exit.
    if(PayrollValidator::year($year) && PayrollValidator::filename($outputFilename))
    {
        $fileManager = new PayrollFileManager($outputFilename);
        $dateManager = new PayrollDateManager($year);
        $payrollManager = new PayrollManager($dateManager);

        $payrollApp = new PayrollApp($payrollManager, $fileManager);
        $payrollApp->run();

    } else {
        fwrite(STDOUT, "Aborting program due to invalid input." . PHP_EOL);
    }
    exit();


