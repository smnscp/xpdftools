<?php

namespace Epubli\Pdf\XpdfTools;

class PdfImagesProcessBuilderTest extends \PHPUnit\Framework\TestCase
{
    const PATH_TO_MINIMAL_PDF = 'data/minimal.pdf';
    const PDFIMAGES_EMPTY_LIST_OUTPUT = <<<EOF
page   num  type   width height color comp bpc  enc interp  object ID x-ppi y-ppi size ratio
--------------------------------------------------------------------------------------------

EOF;

    /** @var bool True, if pdfimages command is available on system. */
    private static $isExecutable;
    /** @var string Path to minimal test PDF file. */
    private $pathToPdf;
    /** @var PdfImagesProcessBuilder */
    private $builder;

    public static function setUpBeforeClass()
    {
        self::$isExecutable = !empty(`which pdfimages`);
    }

    public function setUp()
    {
        $this->pathToPdf = __DIR__.DIRECTORY_SEPARATOR.self::PATH_TO_MINIMAL_PDF;
        $this->builder = new PdfImagesProcessBuilder();
    }

    public function testInit()
    {
        $this->assertEquals(
            "'pdfimages'",
            $this->builder->getProcess()->getCommandLine()
        );
    }

    public function testSetList()
    {
        $this->builder->setList();
        $this->assertEquals(
            "'pdfimages' '-list'",
            $this->builder->getProcess()->getCommandLine()
        );
    }

    public function testRunWithListOptionAndFile()
    {
        if (!self::$isExecutable) {
            $this->markTestSkipped('Command ‘pdfimages’ is not available!');
        }
        $process = $this->builder
            ->setList()
            ->setInputFile($this->pathToPdf)
            ->getProcess();
        $this->assertEquals(0, $process->run());
        $this->assertEquals(true, $process->isSuccessful());
        $this->assertEquals(self::PDFIMAGES_EMPTY_LIST_OUTPUT, $process->getOutput());
    }
    
    public function testRunWithListOptionAndStdin()
    {
        if (!self::$isExecutable) {
            $this->markTestSkipped('Command ‘pdfimages’ is not available!');
        }
        $process = $this->builder
            ->setList()
            ->setInput(file_get_contents($this->pathToPdf))
            ->getProcess();
        $this->assertEquals(0, $process->run());
        $this->assertEquals(true, $process->isSuccessful());
        $this->assertEquals(self::PDFIMAGES_EMPTY_LIST_OUTPUT, $process->getOutput());
    }

    public function testRunWithInvalidInput()
    {
        if (!self::$isExecutable) {
            $this->markTestSkipped('Command ‘pdfimages’ is not available!');
        }
        $process = $this->builder
            ->setList()
            ->setInput('foo')
            ->getProcess();
        $this->assertEquals(1, $process->run());
        $this->assertEquals(false, $process->isSuccessful());
        $this->assertEquals(null, $process->getOutput());
    }
}
