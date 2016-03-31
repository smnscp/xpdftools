<?php

namespace Epubli\Pdf\XpdfTools;

/**
 * Class PdfImagesListRecord keeps the information returned by command line tool pdfimages for one image in a PDF file.

 * @package Epubli\Pdf\XpdfTools
 */
class PdfImagesListRecord
{
    /**
     * @var string the page number containing the image
     */
    private $page;

    /**
     * @var string the image number
     * original name: num
     */
    private $number;

    /**
     * @var string the image type:
     *      image - an opaque image
     *      mask - a monochrome mask image
     *      smask - a soft-mask image
     *      stencil - a monochrome mask image used for painting a color or pattern
     *
     * Note: Tranparency in images is represented in PDF using a separate image for
     * the image and the mask/smask. The mask/smask used as part of a transparent
     * image always immediately follows the image in the image list.
     */
    private $type;

    /**
     * @var string image width (in pixels)
     */
    private $width;

    /**
     * @var string image height (in pixels)
     *
     * Note: the image width/height is the size of the embedded image, not the size the image will be rendered at.
     */
    private $height;

    /**
     * @var string image color space:
     *      gray - Gray
     *      rgb - RGB
     *      cmyk - CMYK
     *      lab - L*a*b
     *      icc - ICC Based
     *      index - Indexed Color
     *      sep - Separation
     *      devn - DeviceN
     *
     * original name: num
     */
    private $colorSpace;

    /**
     * @var int number of color components
     */
    private $colorComponents;

    /**
     * @var int bits per component
     * original name: bpc
     */
    private $bitsPerComponent;

    /**
     * @var string encoding:
     *      image - raster image (may be Flate or LZW compressed but does not use an image encoding)
     *      jpeg - Joint Photographic Experts Group
     *      jp2 - JPEG2000
     *      jbig2 - Joint Bi-Level Image Experts Group
     *      ccitt - CCITT Group 3 or Group 4 Fax
     *
     * original name: enc
     */
    private $encoding;

    /**
     * @var bool whether the interpolation is to be performed when scaling up the image
     * original name: interp
     */
    private $interpolate;

    /**
     * @var int the image dictionary object ID
     * original name: object ID (combining number and generation)
     */
    private $objectId;

    /**
     * @var int the image dictionary object generation
     * original name: object ID (combining number and generation)
     */
    private $objectGeneration;

    /**
     * @var int The horizontal resolution of the image (in pixels per inch) when rendered on the pdf page.
     * original name: x-ppi
     */
    private $horizontalResolution;

    /**
     * @var int The vertical resolution of the image (in pixels per inch) when rendered on the pdf page.
     * original name: y-ppi
     */
    private $verticalResolution;

    /**
     * @var string The size of the embedded image in the pdf file.
     * The following suffixes are used: 'B' bytes, 'K' kilobytes, 'M' megabytes, and 'G' gigabytes.
     */
    private $size;

    /**
     * @var float The compression ratio of the embedded image.
     */
    private $ratio;

    /**
     * @return string
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param string $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param string $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param string $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return string
     */
    public function getColorSpace()
    {
        return $this->colorSpace;
    }

    /**
     * @param string $colorSpace
     */
    public function setColorSpace($colorSpace)
    {
        $this->colorSpace = $colorSpace;
    }

    /**
     * @return int
     */
    public function getColorComponents()
    {
        return $this->colorComponents;
    }

    /**
     * @param int $colorComponents
     */
    public function setColorComponents($colorComponents)
    {
        $this->colorComponents = $colorComponents;
    }

    /**
     * @return int
     */
    public function getBitsPerComponent()
    {
        return $this->bitsPerComponent;
    }

    /**
     * @param int $bitsPerComponent
     */
    public function setBitsPerComponent($bitsPerComponent)
    {
        $this->bitsPerComponent = $bitsPerComponent;
    }

    /**
     * @return string
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * @param string $encoding
     */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;
    }

    /**
     * @return boolean
     */
    public function isInterpolate()
    {
        return $this->interpolate;
    }

    /**
     * @param boolean $interpolate
     */
    public function setInterpolate($interpolate)
    {
        $this->interpolate = $interpolate;
    }

    /**
     * @return int
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * @param int $objectId
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;
    }

    /**
     * @return int
     */
    public function getObjectGeneration()
    {
        return $this->objectGeneration;
    }

    /**
     * @param int $objectGeneration
     */
    public function setObjectGeneration($objectGeneration)
    {
        $this->objectGeneration = $objectGeneration;
    }

    /**
     * @return int
     */
    public function getHorizontalResolution()
    {
        return $this->horizontalResolution;
    }

    /**
     * @param int $horizontalResolution
     */
    public function setHorizontalResolution($horizontalResolution)
    {
        $this->horizontalResolution = $horizontalResolution;
    }

    /**
     * @return int
     */
    public function getVerticalResolution()
    {
        return $this->verticalResolution;
    }

    /**
     * @param int $verticalResolution
     */
    public function setVerticalResolution($verticalResolution)
    {
        $this->verticalResolution = $verticalResolution;
    }
    
    public function getMinResolution()
    {
        return min($this->horizontalResolution, $this->verticalResolution);
    }
   
    public function getMaxResolution()
    {
        return max($this->horizontalResolution, $this->verticalResolution);
    }

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return int
     * @throws \Exception if an unknown suffix is found (see $size).
     */
    public function getSizeInBytes()
    {
        $unit = substr($this->size, -1);
        $value = (float)$this->size;

        switch ($unit) {
            /** @noinspection PhpMissingBreakStatementInspection */
            case 'G':
                $value *= 1024;
            /** @noinspection PhpMissingBreakStatementInspection */
            case 'M':
                $value *= 1024;
            /** @noinspection PhpMissingBreakStatementInspection */
            case 'K':
                $value *= 1024;
            case 'B':
                break;
            default:
                throw new \Exception('Unexpected format for image size in pdfimages output.');
        }

        return (int)round($value);
    }

    /**
     * @param string $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return float
     */
    public function getRatio()
    {
        return $this->ratio;
    }

    /**
     * @param float $ratio
     */
    public function setRatio($ratio)
    {
        $this->ratio = $ratio;
    }
}