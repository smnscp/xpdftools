<?php

namespace Epubli\Pdf\XpdfTools;

class PdfToTextProcessBuilder extends BaseProcessBuilder
{
    public function __construct($prefix = '', $executable = 'pdftotext')
    {
        parent::__construct($prefix.$executable);
    }

    /**
     * Specifies the resolution, in DPI.
     * The default is 72 DPI.
     *
     * @param int $num resolution
     * @return $this
     */
    public function setResolution($num)
    {
        return $this->setOption('r', $num);
    }

    /**
     * Specifies the x-coordinate of the crop area top left corner
     *
     * @param int $num x-coordinate of the crop area
     * @return $this
     */
    public function setCropX($num)
    {
        return $this->setOption('x', $num);
    }

    /**
     * Specifies the y-coordinate of the crop area top left corner
     *
     * @param int $num y-coordinate of the crop area
     * @return $this
     */
    public function setCropY($num)
    {
        return $this->setOption('y', $num);
    }

    /**
     * Specifies the width of crop area in pixels (default is 0)
     *
     * @param int $num width of crop area
     * @return $this
     */
    public function setCropWidth($num)
    {
        return $this->setOption('W', $num);
    }

    /**
     * Specifies the height of crop area in pixels (default is 0)
     *
     * @param int $num height of crop area
     * @return $this
     */
    public function setCropHeight($num)
    {
        return $this->setOption('H', $num);
    }

    /**
     * Maintain (as best as possible) the original physical layout of the text.
     * The default is to ´undo' physical layout (columns, hyphenation, etc.) and output the text in reading order.
     * @return $this
     */
    public function setMaintainLayout()
    {
        return $this->setOption('layout');
    }

    /**
     * Assume fixed-pitch (or tabular) text, with the specified character width (in points).
     * This forces physical layout mode.
     *
     * @param int $num character width
     * @return $this
     */
    public function setFixedPitch($num)
    {
        return $this->setOption('fixed', $num);
    }

    /**
     * Keep the text in content stream order.
     * This is a hack which often "undoes" column formatting, etc.
     * Use of raw mode is no longer recommended.
     *
     * @return $this
     */
    public function setRaw()
    {
        return $this->setOption('raw');
    }

    /**
     * Generate a simple HTML file, including the meta information.
     * This simply wraps the text in <pre> and </pre> and prepends the meta headers.
     *
     * @return $this
     */
    public function setHtmlMeta()
    {
        return $this->setOption('htmlmeta');
    }

    /**
     * Generate an XHTML file containing bounding box information for each word in the file.
     *
     * @return $this
     */
    public function setBbox()
    {
        return $this->setOption('bbox');
    }

    /**
     * Sets the encoding to use for text output. This defaults to "UTF-8".
     *
     * @param string $name encoding name
     * @return $this
     */
    public function setEncoding($name)
    {
        return $this->setOption('enc', $name);
    }

    /**
     * Sets the end-of-line convention to use for text output.
     *
     * @param string $eol unix | dos | mac
     * @return $this
     */
    public function setEndOfLine($eol)
    {
        return $this->setOption('listenc', $eol);
    }

    /**
     * Don't insert page breaks (form feed characters) between pages.
     *
     * @return $this
     */
    public function setNoPageBreak()
    {
        return $this->setOption('nopgbrk');
    }
}
