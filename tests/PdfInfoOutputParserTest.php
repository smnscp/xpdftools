<?php

namespace Epubli\Pdf\XpdfTools;

class PdfInfoOutputParserTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Querformat A4
     */
    public function testParserValid1()
    {

        $outputXpdfInfo = '  Creator:        Writer
Producer:       OpenOffice.org 3.0
CreationDate:   Thu Jul  9 10:34:23 2009
Tagged:         no
UserProperties: no
Suspects:       no
Form:           none
JavaScript:     no
Pages:          324
Encrypted:      no
Page size:      842 x 595 pts (A4)
Page rot:       0
File size:      5390455 bytes
Optimized:      no
PDF version:    1.4';

        $parser = new PdfInfoOutputParser();
        $result = $parser->parse($outputXpdfInfo);

        $this->assertEquals(595, $result->getHeight());
        $this->assertEquals(842, $result->getWidth());
        $this->assertEquals(324, $result->getPagesTotal());
    }

    public function testParserValid2()
    {
        $outputXpdfInfo = 'Author:         John Doe
Creator:        Writer
Producer:       OpenOffice.org 3.0
CreationDate:   Thu Jul  9 10:34:23 2009

Tagged:         no
UserProperties: no
Suspects:       no


Form:           none
JavaScript:     no
Pages:          9
Encrypted:      no
Page size:      230 x 240 pts (AnyOther Format)
Page rot:       0
File size:      5390455 bytes
Optimized:      no
PDF version:    1.4';

        $parser = new PdfInfoOutputParser();
        $result = $parser->parse($outputXpdfInfo);

        $this->assertNull($result->getTitle());
        $this->assertNull($result->getSubject());
        $this->assertNull($result->getKeywords());
        $this->assertEquals('John Doe', $result->getAuthor());
        $this->assertEquals('Writer', $result->getCreator());
        $this->assertEquals('OpenOffice.org 3.0', $result->getProducer());
        $this->assertEquals(new \DateTime('2009-07-09 10:34:23'), $result->getCreationDate());
        $this->assertNull($result->getModificationDate());
        $this->assertFalse($result->isTagged());
        $this->assertFalse($result->hasUserProperties());
        $this->assertFalse($result->hasSuspects());
        $this->assertEquals('none', $result->getForm());
        $this->assertFalse($result->hasJavaScript());
        $this->assertEquals(240, $result->getHeight());
        $this->assertEquals(230, $result->getWidth());
        $this->assertEquals(9, $result->getPagesTotal());
        $this->assertFalse($result->isEncrypted());
        $this->assertNull($result->getPermissions());
        $this->assertEquals(5390455, $result->getFileSize());
        $this->assertFalse($result->isLinearized());
        $this->assertEquals('1.4', $result->getPdfVersion());
    }
}