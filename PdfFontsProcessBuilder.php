<?php

namespace Epubli\Pdf\XpdfTools;

class PdfFontsProcessBuilder extends BaseProcessBuilder
{
    public function __construct($prefix = '', $executable = 'pdffonts')
    {
        parent::__construct($prefix.$executable);
    }
}
