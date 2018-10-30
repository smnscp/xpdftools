<?php

namespace Epubli\Pdf\XpdfTools;

class PdfInfoProcessBuilderTest extends \PHPUnit\Framework\TestCase
{
    const PATH_TO_MINIMAL_PDF = 'data/minimal.pdf';
    const PDFINFO_OUTPUT = <<<EOF
Tagged:         no
UserProperties: no
Suspects:       no
Form:           none
JavaScript:     no
Pages:          1
Encrypted:      no
Page size:      300 x 144 pts
Page rot:       0
File size:      739 bytes
Optimized:      no
PDF version:    1.1

EOF;

    /** @var bool True, if pdfinfo command is available on system. */
    private static $isExecutable;
    /** @var string Path to minimal test PDF file. */
    private $pathToPdf;
    /** @var PdfInfoProcessBuilder */
    private $builder;

    public static function setUpBeforeClass()
    {
        self::$isExecutable = !empty(`which pdfinfo`);
    }

    public function setUp()
    {
        $this->pathToPdf = __DIR__.DIRECTORY_SEPARATOR.self::PATH_TO_MINIMAL_PDF;
        $this->builder = new PdfInfoProcessBuilder();
    }

    public function testInit()
    {
        $this->assertEquals(
            "'pdfinfo'",
            $this->builder->getProcess()->getCommandLine()
        );
    }

    public function testSetInput()
    {
        $this->builder->setInput('foo');
        $this->assertEquals(
            "'pdfinfo' '-'",
            $this->builder->getProcess()->getCommandLine()
        );
    }

    public function testRunWithFile()
    {
        if (!self::$isExecutable) {
            $this->markTestSkipped('Command ‘pdfinfo’ is not available!');
        }
        $process = $this->builder
            ->setInputFile($this->pathToPdf)
            ->getProcess();
        $this->assertEquals(0, $process->run());
        $this->assertEquals(true, $process->isSuccessful());
        $this->assertEquals(self::PDFINFO_OUTPUT, $process->getOutput());
    }

    public function testRunWithStdin()
    {
        if (!self::$isExecutable) {
            $this->markTestSkipped('Command ‘pdfinfo’ is not available!');
        }
        $process = $this->builder
            ->setInput(file_get_contents($this->pathToPdf))
            ->getProcess();
        $this->assertEquals(0, $process->run());
        $this->assertEquals(true, $process->isSuccessful());
        $this->assertEquals(
            // Remove File Size info from both strings since it does not matter, nor does exist in all versions of pdfinfo.
            preg_replace('/File size:.+\n/', '', self::PDFINFO_OUTPUT),
            preg_replace('/File size:.+\n/', '', $process->getOutput())
        );
    }

    public function testRunWithInvalidInput()
    {
        if (!self::$isExecutable) {
            $this->markTestSkipped('Command ‘pdfinfo’ is not available!');
        }
        $process = $this->builder
            ->setInput('foo')
            ->getProcess();
        $this->assertEquals(1, $process->run());
        $this->assertEquals(false, $process->isSuccessful());
        $this->assertEquals(null, $process->getOutput());
    }
}
