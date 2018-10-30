<?php

namespace Epubli\Pdf\XpdfTools;

class PdfToHtmlProcessBuilderTest extends \PHPUnit\Framework\TestCase
{
    const PATH_TO_MINIMAL_PDF = 'data/minimal.pdf';
    const PDFTOHTML_OUTPUT = <<<EOF
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="" xml:lang="">
<head>
<title>%s</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="generator" content="pdftohtml %f"/>
%A
</head>
<body%s>
%a
</body>
</html>
EOF;


    /** @var bool True, if pdftohtml command is available on system. */
    private static $isExecutable;
    /** @var string Path to minimal test PDF file. */
    private $pathToPdf;
    /** @var PdfToHtmlProcessBuilder */
    private $builder;

    public static function setUpBeforeClass()
    {
        self::$isExecutable = !empty(`which pdftohtml`);
    }

    public function setUp()
    {
        $this->pathToPdf = __DIR__.DIRECTORY_SEPARATOR.self::PATH_TO_MINIMAL_PDF;
        $this->builder = new PdfToHtmlProcessBuilder();
    }

    public function testInit()
    {
        $this->assertEquals(
            "'pdftohtml'",
            $this->builder->getProcess()->getCommandLine()
        );
    }

    /**
     * @expectedException \Epubli\Pdf\XpdfTools\Exception
     * @expectedExceptionMessage pdftohtml does not support input via stdin.
     */
    public function testSetInputThrowsException()
    {
        $this->builder->setInput('does not matter');
    }

    public function testSetOutputStdout()
    {
        $this->assertEquals(
            "'pdftohtml' '-stdout'",
            $this->builder->setOutputStdout()->getProcess()->getCommandLine()
        );
    }

    public function testRun()
    {
        if (!self::$isExecutable) {
            $this->markTestSkipped('Command ‘pdftohtml’ is not available!');
        }
        $process = $this->builder
            ->setInputFile($this->pathToPdf)
            ->setOutputStdout()
            ->getProcess();
        $this->assertEquals(0, $process->run());
        $this->assertEquals(true, $process->isSuccessful());
        $this->assertStringMatchesFormat(self::PDFTOHTML_OUTPUT, $process->getOutput());
    }
}
