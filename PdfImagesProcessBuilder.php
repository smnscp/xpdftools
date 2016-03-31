<?php

namespace Epubli\Pdf\XpdfTools;

class PdfImagesProcessBuilder extends BaseProcessBuilder
{
    public function __construct($executable = 'pdfimages')
    {
        parent::__construct($executable);
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
