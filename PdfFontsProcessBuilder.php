<?php

namespace Epubli\Pdf\XpdfTools;

class PdfFontsProcessBuilder extends BaseProcessBuilder
{
    public function __construct($executable = 'pdffonts')
    {
        parent::__construct($executable);
    }
}
