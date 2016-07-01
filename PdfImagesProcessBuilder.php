<?php

namespace Epubli\Pdf\XpdfTools;

class PdfImagesProcessBuilder extends BaseProcessBuilder
{
    public function __construct($prefix = '', $executable = 'pdfimages')
    {
        parent::__construct($prefix.$executable);
    }

    /**
     * Print list of images instead of saving.
     *
     * @return $this
     */
    public function setList()
    {
        return $this->setOption('list');
    }
}
