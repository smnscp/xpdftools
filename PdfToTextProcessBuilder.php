<?php

namespace Epubli\Pdf\XpdfTools;

class PdfToTextProcessBuilder extends BaseProcessBuilder
{
    public function __construct($executable = 'pdftotext')
    {
        parent::__construct($executable);
    }
}
