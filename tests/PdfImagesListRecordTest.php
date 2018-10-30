<?php

namespace Epubli\Pdf\XpdfTools;

class PdfImagesListRecordTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Unexpected format for image size
     */
    public function testGetSizeInBytesThrowsExceptionWithUnknownSizeFormat()
    {
        $record = new PdfImagesListRecord();
        $record->setSize('15.8T');
        $record->getSizeInBytes();

        $this->setExpectedException('\Exception');
    }

    public function testGetSizeInBytesGbyte()
    {
        $record = new PdfImagesListRecord();
        $record->setSize('15.8G');
        $byteValue = $record->getSizeInBytes();

        $this->assertEquals(16965120819, $byteValue);
    }

    public function testGetSizeInBytesKbyte()
    {
        $record = new PdfImagesListRecord();
        // Upper-case K because 'man pdfimages' yields: “The following suffixes are used: 'B' bytes, 'K' kilobytes, 'M' megabytes, and 'G' gigabytes.”
        $record->setSize('1024K');
        $byteValue = $record->getSizeInBytes();

        $this->assertEquals(1048576, $byteValue);
    }

    public function testGetSizeInBytesMbyte()
    {
        $record = new PdfImagesListRecord();
        $record->setSize('512M');
        $byteValue = $record->getSizeInBytes();

        $this->assertEquals(536870912, $byteValue);
    }
}
