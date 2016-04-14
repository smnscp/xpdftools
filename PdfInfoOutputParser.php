<?php

namespace Epubli\Pdf\XpdfTools;

class PdfInfoOutputParser
{
    /**
     * @param string $pdfImagesOutput
     * @return PdfInfoParserResult
     */
    public function parse($pdfImagesOutput)
    {
        $lines = explode(PHP_EOL, trim($pdfImagesOutput));

        $result = new PdfInfoParserResult();

        foreach ($lines as $line) {
            $fields = preg_split('/: /', $line);

            if (empty($fields[1])) {
                continue;
            }

            $valueCleaned = str_replace(' ', '', $fields[1]);

            if ($fields[0] == 'Pages') {
                $result->setPagesTotal((int)$valueCleaned);
            }

            if ($fields[0] == 'Page size') {
                $valueCleaned = str_replace('pts', '', $valueCleaned);
                $valueCleaned = preg_replace('/(\(.*\))/', '', $valueCleaned);

                $valueArray = preg_split('/x/', $valueCleaned);
                $result->setWidth((int)$valueArray[0]);
                $result->setHeight((int)$valueArray[1]);
            }
        }

        return $result;
    }
}
