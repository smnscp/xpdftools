<?php

namespace Epubli\Pdf\XpdfTools;

class PdfToPpmProcessBuilder extends BaseProcessBuilder
{
    public function __construct($prefix = '', $executable = 'pdftoppm')
    {
        parent::__construct($prefix.$executable);
    }

    /**
     * Writes only the first page and does not add digits.
     *
     * @return $this
     */
    public function setSingleFile()
    {
        return $this->setOption('singlefile');
    }

    /**
     * Specifies the X and Y resolution, in DPI.
     * The default is 150 DPI.
     *
     * @param int $num resolution
     * @return $this
     */
    public function setResolution($num)
    {
        return $this->setOption('r', $num);
    }

    /**
     * Specifies the X resolution, in DPI.
     * The default is 150 DPI.
     *
     * @param int $num resolution
     * @return $this
     */
    public function setResolutionX($num)
    {
        return $this->setOption('rx', $num);
    }

    /**
     * Specifies the Y resolution, in DPI.
     * The default is 150 DPI.
     *
     * @param int $num resolution
     * @return $this
     */
    public function setResolutionY($num)
    {
        return $this->setOption('ry', $num);
    }

    /**
     * Scales the long side of each page (width for landscape pages, height for portrait pages)
     * to fit in scale-to pixels. The size of the short side will be determined by the aspect ratio of the page.
     * @param int $num target size of the long side 
     * @return $this
     */
    public function setScaleTo($num)
    {
        return $this->setOption('scale-to', $num);
    }
    
    /**
     * Scales each page horizontally to fit in scale-to-x pixels.
     * If scale-to-y is set to -1, the vertical size will determined by the aspect ratio of the page.
     * @param int $num target size of the horizontal side
     * @return $this
     */
    public function setScaleToX($num)
    {
        return $this->setOption('scale-to-x', $num);
    }

    /**
     * Scales each page vertically to fit in scale-to-y pixels.
     * If scale-to-x is set to -1, the horizontal size will determined by the aspect ratio of the page.
     * @param int $num target size of the vertical side
     * @return $this
     */
    public function setScaleToY($num)
    {
        return $this->setOption('scale-to-y', $num);
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
     * Specifies the size of crop square in pixels (sets W and H)
     *
     * @param int $num height of crop area
     * @return $this
     */
    public function setCropSize($num)
    {
        return $this->setOption('sz', $num);
    }

    /**
     * Uses the crop box rather than media box when generating the files
     */
    public function setUseCropBox()
    {
        return $this->setOption('cropbox');
    }

    /**
     * Generate a monochrome PBM file (instead of a color PPM file).
     */
    public function setOutputFormatMono()
    {
        return $this->setOption('mono');
    }

    /**
     * Generate a grayscale PGM file (instead of a color PPM file).
     */
    public function setOutputFormatGray()
    {
        return $this->setOption('gray');
    }

    /**
     * Generates a PNG file instead a PPM file.
     */
    public function setOutputFormatPng()
    {
        return $this->setOption('png');
    }

    /**
     * Generates a JPEG file instead a PPM file.
     */
    public function setOutputFormatJpeg()
    {
        return $this->setOption('jpeg');
    }

    /**
     * Generates a TIFF file instead a PPM file.
     */
    public function setOutputFormatTiff()
    {
        return $this->setOption('tiff');
    }

/**
 * -tiffcompression none | packbits | jpeg | lzw | deflate
Specifies the TIFF compression type.  This defaults to "none".

-freetype yes | no
Enable or disable FreeType (a TrueType / Type 1 font rasterizer).  This defaults to "yes".

-thinlinemode none | solid | shape
Specifies the thin line mode. This defaults to "none".

"solid":
adjust lines with a width less than one pixel to pixel boundary and paint it with a width of one pixel.

"shape":
adjust lines with a width less than one pixel to pixel boundary and paint it with a width of one pixel but with a shape in proportion to its width.

-aa yes | no
Enable or disable font anti-aliasing.  This defaults to "yes".

-aaVector yes | no
Enable or disable vector anti-aliasing.  This defaults to "yes".
*/
}
