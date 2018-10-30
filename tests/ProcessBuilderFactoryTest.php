<?php

namespace Epubli\Pdf\XpdfTools;

use PHPUnit\Framework\TestCase;

class ProcessBuilderFactoryTest extends TestCase
{
    /** @var ProcessBuilderFactory */
    private $factory;

    public function setUp()
    {
        $this->factory = new ProcessBuilderFactory();
    }

    public function testCreatePdfInfoProcessBuilder()
    {
        $this->assertInstanceOf(PdfInfoProcessBuilder::class, $this->factory->create('pdfinfo'));
    }

    public function testCreatePdfFontsProcessBuilder()
    {
        $this->assertInstanceOf(PdfFontsProcessBuilder::class, $this->factory->create('pdffonts'));
    }

    public function testCreatePdfImagesProcessBuilder()
    {
        $this->assertInstanceOf(PdfImagesProcessBuilder::class, $this->factory->create('pdfimages'));
    }

    public function testCreatePdfToTextProcessBuilder()
    {
        $this->assertInstanceOf(PdfToTextProcessBuilder::class, $this->factory->create('pdftotext'));
    }

    public function testCreatePdfToHtmlProcessBuilder()
    {
        $this->assertInstanceOf(PdfToHtmlProcessBuilder::class, $this->factory->create('pdftohtml'));
    }

    /**
     * @expectedException \Epubli\Pdf\XpdfTools\Exception
     * @expectedExceptionMessage Xpdf tools process builder for key 'pdftofoo' does not exist.
     */
    public function testCreateThrowsExceptionWithUnknownKey()
    {
        $this->factory->create('pdftofoo');
    }
}
