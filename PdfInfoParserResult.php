<?php

namespace Epubli\Pdf\XpdfTools;

class PdfInfoParserResult
{
    /**
     * @var int
     */
    private $pagesTotal;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @return int
     */
    public function getPagesTotal()
    {
        return $this->pagesTotal;
    }

    /**
     * @param int $pagesTotal
     */
    public function setPagesTotal($pagesTotal)
    {
        $this->pagesTotal = $pagesTotal;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }
}
