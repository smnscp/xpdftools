<?php

namespace Epubli\Pdf\XpdfTools;

class PdfImagesListOutputParserTest extends \PHPUnit\Framework\TestCase
{
    const PDFIMAGES_OUTPUT = <<<EOF
page   num  type   width height color comp bpc  enc interp  object ID x-ppi y-ppi size ratio
--------------------------------------------------------------------------------------------
   1     0 image     321    29  rgb     3   8  image  no         9  0   221   221  730B 2.6%
   1     1 smask     321    29  gray    1   8  image  no         9  0   221   221 2628B  28%
   4     2 image    1039   779  rgb     3   8  jpeg   no        43  0   289   290  159K 6.7%
  12     3 image     683   512  rgb     3   8  jpeg   yes       45  2   320   321 74.9K 7.3%
  38     4 image     200   309  rgb     3   8  jpeg   no        84  0  1202  1203  1.1M  49%
 119     5 image   20000 20000  cmyk    4  16  jpeg   yes      124  1 12002 12000 12.3G 100%

EOF;

    public function testParse()
    {
        $parser = new PdfImagesListOutputParser();
        $records = $parser->parse(self::PDFIMAGES_OUTPUT);

        $this->assertCount(6, $records);

        $record = $records[0];
        $this->assertInstanceOf(PdfImagesListRecord::class, $record);
        $this->assertSame(1, $record->getPage());
        $this->assertSame(0, $record->getNumber());
        $this->assertSame('image', $record->getType());
        $this->assertSame(321, $record->getWidth());
        $this->assertSame(29, $record->getHeight());
        $this->assertSame('rgb', $record->getColorSpace());
        $this->assertSame(3, $record->getColorComponents());
        $this->assertSame(8, $record->getBitsPerComponent());
        $this->assertSame('image', $record->getEncoding());
        $this->assertFalse($record->isInterpolate());
        $this->assertSame(9, $record->getObjectId());
        $this->assertSame(0, $record->getObjectGeneration());
        $this->assertSame(221, $record->getHorizontalResolution());
        $this->assertSame(221, $record->getVerticalResolution());
        $this->assertSame(221, $record->getMinResolution());
        $this->assertSame(221, $record->getMaxResolution());
        $this->assertSame('730B', $record->getSize());
        $this->assertSame(730, $record->getSizeInBytes());
        $this->assertSame(0.026, $record->getRatio());

        $record = $records[1];
        $this->assertInstanceOf(PdfImagesListRecord::class, $record);
        $this->assertSame(1, $record->getPage());
        $this->assertSame(1, $record->getNumber());
        $this->assertSame('smask', $record->getType());
        $this->assertSame(321, $record->getWidth());
        $this->assertSame(29, $record->getHeight());
        $this->assertSame('gray', $record->getColorSpace());
        $this->assertSame(1, $record->getColorComponents());
        $this->assertSame(8, $record->getBitsPerComponent());
        $this->assertSame('image', $record->getEncoding());
        $this->assertFalse($record->isInterpolate());
        $this->assertSame(9, $record->getObjectId());
        $this->assertSame(0, $record->getObjectGeneration());
        $this->assertSame(221, $record->getHorizontalResolution());
        $this->assertSame(221, $record->getVerticalResolution());
        $this->assertSame(221, $record->getMinResolution());
        $this->assertSame(221, $record->getMaxResolution());
        $this->assertSame('2628B', $record->getSize());
        $this->assertSame(2628, $record->getSizeInBytes());
        $this->assertSame(0.28, $record->getRatio());

        $record = $records[2];
        $this->assertInstanceOf(PdfImagesListRecord::class, $record);
        $this->assertSame(4, $record->getPage());
        $this->assertSame(2, $record->getNumber());
        $this->assertSame('image', $record->getType());
        $this->assertSame(1039, $record->getWidth());
        $this->assertSame(779, $record->getHeight());
        $this->assertSame('rgb', $record->getColorSpace());
        $this->assertSame(3, $record->getColorComponents());
        $this->assertSame(8, $record->getBitsPerComponent());
        $this->assertSame('jpeg', $record->getEncoding());
        $this->assertFalse($record->isInterpolate());
        $this->assertSame(43, $record->getObjectId());
        $this->assertSame(0, $record->getObjectGeneration());
        $this->assertSame(289, $record->getHorizontalResolution());
        $this->assertSame(290, $record->getVerticalResolution());
        $this->assertSame(289, $record->getMinResolution());
        $this->assertSame(290, $record->getMaxResolution());
        $this->assertSame('159K', $record->getSize());
        $this->assertSame(162816, $record->getSizeInBytes());
        $this->assertSame(0.067, $record->getRatio());

        $record = $records[3];
        $this->assertInstanceOf(PdfImagesListRecord::class, $record);
        $this->assertSame(12, $record->getPage());
        $this->assertSame(3, $record->getNumber());
        $this->assertSame('image', $record->getType());
        $this->assertSame(683, $record->getWidth());
        $this->assertSame(512, $record->getHeight());
        $this->assertSame('rgb', $record->getColorSpace());
        $this->assertSame(3, $record->getColorComponents());
        $this->assertSame(8, $record->getBitsPerComponent());
        $this->assertSame('jpeg', $record->getEncoding());
        $this->assertTrue($record->isInterpolate());
        $this->assertSame(45, $record->getObjectId());
        $this->assertSame(2, $record->getObjectGeneration());
        $this->assertSame(320, $record->getHorizontalResolution());
        $this->assertSame(321, $record->getVerticalResolution());
        $this->assertSame(320, $record->getMinResolution());
        $this->assertSame(321, $record->getMaxResolution());
        $this->assertSame('74.9K', $record->getSize());
        $this->assertSame(76698, $record->getSizeInBytes());
        $this->assertSame(0.073, $record->getRatio());

        $record = $records[4];
        $this->assertInstanceOf(PdfImagesListRecord::class, $record);
        $this->assertSame(38, $record->getPage());
        $this->assertSame(4, $record->getNumber());
        $this->assertSame('image', $record->getType());
        $this->assertSame(200, $record->getWidth());
        $this->assertSame(309, $record->getHeight());
        $this->assertSame('rgb', $record->getColorSpace());
        $this->assertSame(3, $record->getColorComponents());
        $this->assertSame(8, $record->getBitsPerComponent());
        $this->assertSame('jpeg', $record->getEncoding());
        $this->assertFalse($record->isInterpolate());
        $this->assertSame(84, $record->getObjectId());
        $this->assertSame(0, $record->getObjectGeneration());
        $this->assertSame(1202, $record->getHorizontalResolution());
        $this->assertSame(1203, $record->getVerticalResolution());
        $this->assertSame(1202, $record->getMinResolution());
        $this->assertSame(1203, $record->getMaxResolution());
        $this->assertSame('1.1M', $record->getSize());
        $this->assertSame(1153434, $record->getSizeInBytes());
        $this->assertSame(0.49, $record->getRatio());

        $record = $records[5];
        $this->assertInstanceOf(PdfImagesListRecord::class, $record);
        $this->assertSame(119, $record->getPage());
        $this->assertSame(5, $record->getNumber());
        $this->assertSame('image', $record->getType());
        $this->assertSame(20000, $record->getWidth());
        $this->assertSame(20000, $record->getHeight());
        $this->assertSame('cmyk', $record->getColorSpace());
        $this->assertSame(4, $record->getColorComponents());
        $this->assertSame(16, $record->getBitsPerComponent());
        $this->assertSame('jpeg', $record->getEncoding());
        $this->assertTrue($record->isInterpolate());
        $this->assertSame(124, $record->getObjectId());
        $this->assertSame(1, $record->getObjectGeneration());
        $this->assertSame(12002, $record->getHorizontalResolution());
        $this->assertSame(12000, $record->getVerticalResolution());
        $this->assertSame(12000, $record->getMinResolution());
        $this->assertSame(12002, $record->getMaxResolution());
        $this->assertSame('12.3G', $record->getSize());
        $this->assertSame(13207024435, $record->getSizeInBytes());
        $this->assertSame(1., $record->getRatio());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Unexpected header
     */
    public function testThrowsExceptionWithUnknownHeader()
    {
        $parser = new PdfImagesListOutputParser();
        $corruptOutput = str_replace(str_split('orig -'), str_split('b!tr0+'), self::PDFIMAGES_OUTPUT);
        $parser->parse($corruptOutput);
    }
}