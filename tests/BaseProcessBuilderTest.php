<?php

namespace Epubli\Pdf\XpdfTools;

use PHPUnit\Framework\TestCase;

class BaseProcessBuilderTest extends TestCase
{
    const EXECUTABLE = 'some-pdf-tool';
    const INPUT_STRING = 'foo';
    const INPUT_FILE = 'input.pdf';
    const OUTPUT_FILE = 'output.ps';

    /** @var BaseProcessBuilder */
    private $builder;

    public function setUp()
    {
        $this->builder = $this->getMockForAbstractClass(BaseProcessBuilder::class, [self::EXECUTABLE]);
    }

    public function testInit()
    {
        $process = $this->builder->getProcess();

        $this->assertEquals("'".self::EXECUTABLE."'", $process->getCommandLine());
        $this->assertNull($process->getInput());
    }

    public function testSetInputFile()
    {
        $this->builder->setInputFile(self::INPUT_FILE);
        $process = $this->builder->getProcess();

        $this->assertEquals("'".self::EXECUTABLE."' '".self::INPUT_FILE."'", $process->getCommandLine());
        $this->assertNull($process->getInput());
    }

    /**
     * @dataProvider provideBool
     * @param bool $reverseOrder Whether to set output file before input file.
     */
    public function testSetInputAndOutputFile($reverseOrder)
    {
        if ($reverseOrder) {
            $this->builder->setOutputFile(self::OUTPUT_FILE)->setInputFile(self::INPUT_FILE);
        } else {
            $this->builder->setInputFile(self::INPUT_FILE)->setOutputFile(self::OUTPUT_FILE);
        }
        $process = $this->builder->getProcess();

        $this->assertEquals(
            "'".self::EXECUTABLE."' '".self::INPUT_FILE."' '".self::OUTPUT_FILE."'",
            $process->getCommandLine()
        );
        $this->assertNull($process->getInput());
    }

    public function testInputIsSetToStdinIfOnlyOutputFileSet()
    {
        $this->builder->setOutputFile(self::OUTPUT_FILE);
        $process = $this->builder->getProcess();

        $this->assertEquals("'".self::EXECUTABLE."' '-' '".self::OUTPUT_FILE."'", $process->getCommandLine());
        $this->assertNull($process->getInput());
    }

    /**
     * @dataProvider provideBool
     * @param bool $reverseOrder Whether to set output before input.
     */
    public function testSetStdinAndStdout($reverseOrder)
    {
        if ($reverseOrder) {
            $this->builder->setOutputStdout()->setInputStdin();
        } else {
            $this->builder->setInputStdin()->setOutputStdout();
        }
        $process = $this->builder->getProcess();

        $this->assertEquals("'".self::EXECUTABLE."' '-' '-'", $process->getCommandLine());
        $this->assertNull($process->getInput());
    }

    public function testSetInput()
    {
        $this->builder->setInput(self::INPUT_STRING);
        $process = $this->builder->getProcess();

        $this->assertEquals("'".self::EXECUTABLE."' '-'", $process->getCommandLine());
        $this->assertEquals(self::INPUT_STRING, $process->getInput());
    }

    public function testSetOptionsAndFiles()
    {
        $this->builder
            ->setFirstPage(23)
            ->setInputFile(self::INPUT_FILE)
            ->setLastPage(42)
            ->setOutputFile(self::OUTPUT_FILE)
            ->setQuiet()
            ->setPrintHelp()
            ->setPrintInfo();
        $process = $this->builder->getProcess();

        $this->assertEquals(
            "'".self::EXECUTABLE."' '-f' '23' '-l' '42' '-q' '-h' '-v' '".self::INPUT_FILE."' '".self::OUTPUT_FILE."'",
            $process->getCommandLine()
        );
        $this->assertNull($process->getInput());
    }

    public function provideBool()
    {
        return [[false], [true]];
    }
}