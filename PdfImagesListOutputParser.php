<?php

namespace Epubli\Pdf\XpdfTools;

/**
 * Class PdfImagesListOutputParser parses the output of command line tool pdfimages.
 * Accepts output of the following command:
 *
 * $ pdfimages -list [other options] PDF-file
 *
 * About the -list option (from pdfimages man page):
 * “Instead  of writing the images, list the images along with various information for each image.
 * Do  not  specify  an  image-root with this option.”
 *
 * @package Epubli\Pdf\XpdfTools
 */
class PdfImagesListOutputParser
{
    const KNOWN_HEADER = <<<'EOF'
page   num  type   width height color comp bpc  enc interp  object ID x-ppi y-ppi size ratio
--------------------------------------------------------------------------------------------
EOF;

    /**
     * Parse the output of [pdfimages -list].
     * @param string $pdfImagesOutput The complete output of [pdfimages -list]
     * @return array|PdfImagesListRecord[] A record for each image with the information listed by pdfimages.
     * @throws \Exception If the header of the output has an unexpected format.
     */
    public function parse($pdfImagesOutput)
    {
        $lines = explode(PHP_EOL, trim($pdfImagesOutput));
        $header = array_shift($lines).PHP_EOL.array_shift($lines);

        $header = preg_replace('/[\x00-\x1F\x7F]/', '', $header);
        $header2 = preg_replace('/[\x00-\x1F\x7F]/', '', self::KNOWN_HEADER);

        if ($header != $header2) {
            throw new \Exception('Unexpected header while parsing pdfimages output.');
        }

        $records = [];
        foreach ($lines as $line) {
            $fields = preg_split('/\s+/', $line);
            $record = new PdfImagesListRecord();
            $record->setRatio(((float)array_pop($fields)) / 100);
            $record->setSize(array_pop($fields));
            $record->setVerticalResolution((int)array_pop($fields));
            $record->setHorizontalResolution((int)array_pop($fields));
            $record->setObjectGeneration((int)array_pop($fields));
            $record->setObjectId((int)array_pop($fields));
            $record->setInterpolate(array_pop($fields) == 'yes');
            $record->setEncoding(array_pop($fields));
            $record->setBitsPerComponent((int)array_pop($fields));
            $record->setColorComponents((int)array_pop($fields));
            $record->setColorSpace(array_pop($fields));
            $record->setHeight((int)array_pop($fields));
            $record->setWidth((int)array_pop($fields));
            $record->setType(array_pop($fields));
            $record->setNumber((int)array_pop($fields));
            $record->setPage((int)array_pop($fields));

            $records[] = $record;
        }

        return $records;
    }
}
