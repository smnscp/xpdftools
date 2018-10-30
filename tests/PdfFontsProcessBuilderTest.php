<?php

namespace Epubli\Pdf\XpdfTools;

class PdfFontsProcessBuilderTest extends \PHPUnit\Framework\TestCase
{
    const PATH_TO_MINIMAL_PDF = 'data/minimal.pdf';
    const PDFFONTS_OUTPUT = <<<EOF
name                                 type              encoding         emb sub uni object ID
------------------------------------ ----------------- ---------------- --- --- --- ---------
Times-Roman                          Type 1            Standard         no  no  no  [none]

EOF;

    /** @var bool True, if pdffonts command is available on system. */
    private static $isExecutable;
    /** @var string Path to minimal test PDF file. */
    private $pathToPdf;
    /** @var PdfFontsProcessBuilder */
    private $builder;

    public static function setUpBeforeClass()
    {
        self::$isExecutable = !empty(`which pdffonts`);
    }

    public function setUp()
    {
        $this->pathToPdf = __DIR__.DIRECTORY_SEPARATOR.self::PATH_TO_MINIMAL_PDF;
        $this->builder = new PdfFontsProcessBuilder();
    }

    public function testInit()
    {
        $this->assertEquals(
            "'pdffonts'",
            $this->builder->getProcess()->getCommandLine()
        );
    }

    public function testSetInput()
    {
        $this->builder->setInput('foo');
        $this->assertEquals(
            "'pdffonts' '-'",
            $this->builder->getProcess()->getCommandLine()
        );
    }

    public function testRunWithFile()
    {
        if (!self::$isExecutable) {
            $this->markTestSkipped('Command ‘pdffonts’ is not available!');
        }
        $process = $this->builder
            ->setInputFile($this->pathToPdf)
            ->getProcess();
        $this->assertEquals(0, $process->run());
        $this->assertEquals(true, $process->isSuccessful());
        $this->assertEquals(self::PDFFONTS_OUTPUT, $process->getOutput());
    }

    public function testRunWithStdin()
    {
        if (!self::$isExecutable) {
            $this->markTestSkipped('Command ‘pdffonts’ is not available!');
        }
        $process = $this->builder
            ->setInput(file_get_contents($this->pathToPdf))
            ->getProcess();
        $this->assertEquals(0, $process->run());
        $this->assertEquals(true, $process->isSuccessful());
        $this->assertEquals(self::PDFFONTS_OUTPUT, $process->getOutput());
    }

    public function testRunWithInvalidInput()
    {
        if (!self::$isExecutable) {
            $this->markTestSkipped('Command ‘pdffonts’ is not available!');
        }
        $process = $this->builder
            ->setInput('foo')
            ->getProcess();
        $this->assertEquals(1, $process->run());
        $this->assertEquals(false, $process->isSuccessful());
        $this->assertEquals(null, $process->getOutput());
    }
}
