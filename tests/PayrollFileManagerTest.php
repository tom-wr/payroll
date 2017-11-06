<?php

use App\PayrollFileManager;
use PHPUnit\Framework\TestCase;

class PayrollFileManagerTest extends TestCase
{
    private $fileHeader;
    private $testString;
    private $dustbin;

    public function setUp(){
        $this->fileHeader = '"Month Name", "1st Expenses Day", "2nd Expenses Day", "Salary Day"' . PHP_EOL;
        $this->testString = 'test string';
        $this->dustbin = [];
    }

    protected function tearDown()
    {
        // delete test files
        foreach($this->dustbin as $file)
        {
            unlink($file);
        }

    }

    public function testWritesContentToFile()
    {
        $outputFilename = "test_writes_to_file";
        $path = './' . $outputFilename . '.txt';
        $expectedContents =  $this->fileHeader . $this->testString;
        $fileManager = new PayrollFileManager($outputFilename);

        $fileManager->write($this->testString);
        $this->dustbin[] = $path;

        $contents = file_get_contents($path);
        $this->assertFileExists($path);
        $this->assertEquals($expectedContents, $contents);

    }

    public function testOverwritesExistingFile()
    {
        $outputFilename = "test_overwrites";
        $path = './' . $outputFilename . '.txt';
        $this->dustbin[] = $path;
        $testStringOverwrite = "testing overwrite";
        $expectedContents =  $this->fileHeader . $testStringOverwrite;

        $fileManager = new PayrollFileManager($outputFilename);
        $fileManager->write($this->testString);
        $fileManager->write($testStringOverwrite);
        $contents = file_get_contents($path);
        $this->assertEquals($expectedContents, $contents);
    }

}
