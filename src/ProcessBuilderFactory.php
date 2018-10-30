<?php

namespace Epubli\Pdf\XpdfTools;

use Epubli\Process\Exception as ProcessException;
use Epubli\Process\ProcessBuilderFactory as BaseProcessBuilderFactory;

/**
 * Class ProcessBuilderFactory is a service that creates new instances of various ProcessBuilders for XPDF Tools.
 *
 * @package Epubli\Pdf\XpdfTools
 */
class ProcessBuilderFactory extends BaseProcessBuilderFactory
{
    public function __construct($prefix = '')
    {
        parent::__construct($prefix);
        $this->register('pdfinfo', PdfInfoProcessBuilder::class);
        $this->register('pdffonts', PdfFontsProcessBuilder::class);
        $this->register('pdfimages', PdfImagesProcessBuilder::class);
        $this->register('pdftotext', PdfToTextProcessBuilder::class);
        $this->register('pdftohtml', PdfToHtmlProcessBuilder::class);
        $this->register('pdftoppm', PdfToPpmProcessBuilder::class);
    }

    /**
     * @param string $key
     * @return BaseProcessBuilder
     * @throws Exception
     */
    public function create($key)
    {
        try {
            /** @var BaseProcessBuilder $processBuilder */
            $processBuilder = parent::create($key);

            return $processBuilder;
        } catch (ProcessException $ex) {
            throw new Exception("Xpdf tools process builder for key '$key' does not exist.");
        }
    }
}
