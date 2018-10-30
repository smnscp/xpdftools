<?php

namespace Epubli\Pdf\XpdfTools;

class PdfToTextProcessBuilderTest extends \PHPUnit\Framework\TestCase
{
    const PATH_TO_MINIMAL_PDF = 'data/minimal.pdf';
    const PDFTOTEXT_OUTPUT = "Hello World";

    /** @var bool True, if pdftotext command is available on system. */
    private static $isExecutable;
    /** @var string Path to minimal test PDF file. */
    private $pathToPdf;
    /** @var PdfToTextProcessBuilder */
    private $builder;

    public static function setUpBeforeClass()
    {
        self::$isExecutable = !empty(`which pdftotext`);
    }

    public function setUp()
    {
        $this->pathToPdf = __DIR__.DIRECTORY_SEPARATOR.self::PATH_TO_MINIMAL_PDF;
        $this->builder = new PdfToTextProcessBuilder();
    }

    public function testInit()
    {
        $this->assertEquals(
            "'pdftotext'",
            $this->builder->getProcess()->getCommandLine()
        );
    }

    public function testRunWithFile()
    {
        if (!self::$isExecutable) {
            $this->markTestSkipped('Command ‘pdftotext’ is not available!');
        }
        $process = $this->builder
            ->setInputFile($this->pathToPdf)
            ->setOutputStdout()
            ->getProcess();
        $this->assertEquals(0, $process->run());
        $this->assertEquals(true, $process->isSuccessful());
        $this->assertEquals(self::PDFTOTEXT_OUTPUT, trim($process->getOutput(), " \n\f"));
    }

    public function testRunWithStdin()
    {
        if (!self::$isExecutable) {
            $this->markTestSkipped('Command ‘pdftotext’ is not available!');
        }
        $process = $this->builder
            ->setInput(file_get_contents($this->pathToPdf))
            ->setOutputStdout()
            ->getProcess();
        $this->assertEquals(0, $process->run());
        $this->assertEquals(true, $process->isSuccessful());
        $this->assertEquals(self::PDFTOTEXT_OUTPUT, trim($process->getOutput(), " \n\f"));
    }

    public function testRunWithInvalidInput()
    {
        if (!self::$isExecutable) {
            $this->markTestSkipped('Command ‘pdftotext’ is not available!');
        }
        $process = $this->builder
            ->setInput('foo')
            ->getProcess();
        $this->assertEquals(1, $process->run());
        $this->assertEquals(false, $process->isSuccessful());
        $this->assertEquals(null, $process->getOutput());
    }
}
