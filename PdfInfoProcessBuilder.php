<?php

namespace Epubli\Pdf\XpdfTools;

class PdfInfoProcessBuilder extends BaseProcessBuilder
{
    public function __construct($executable = 'pdfinfo')
    {
        parent::__construct($executable);
    }
}
