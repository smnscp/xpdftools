<?php

namespace Epubli\Pdf\XpdfTools;

class PdfInfoProcessBuilder extends BaseProcessBuilder
{
    public function __construct($prefix = '', $executable = 'pdfinfo')
    {
        parent::__construct($prefix.$executable);
    }
}
