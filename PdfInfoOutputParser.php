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

            $valueCleaned = trim($fields[1]);

            switch ($fields[0]) {
                case 'Title':
                    $result->setTitle($valueCleaned);
                    break;
                case 'Subject':
                    $result->setSubject($valueCleaned);
                    break;
                case 'Keywords':
                    $result->setKeywords($valueCleaned);
                    break;
                case 'Author':
                    $result->setAuthor($valueCleaned);
                    break;
                case 'Creator':
                    $result->setCreator($valueCleaned);
                    break;
                case 'Producer':
                    $result->setProducer($valueCleaned);
                    break;
                case 'CreationDate':
                    $result->setCreationDate(new \DateTime($valueCleaned));
                    break;
                case 'ModDate':
                    $result->setModificationDate(new \DateTime($valueCleaned));
                    break;
                case 'Tagged':
                    $result->setTagged($valueCleaned == 'yes');
                    break;
                case 'UserProperties':
                    $result->setUserProperties($valueCleaned == 'yes');
                    break;
                case 'Suspects':
                    $result->setSuspects($valueCleaned == 'yes');
                    break;
                case 'Form':
                    $result->setForm($valueCleaned);
                    break;
                case 'JavaScript':
                    $result->setJavaScript($valueCleaned == 'yes');
                    break;
                case 'Pages':
                    $result->setPagesTotal((int)$valueCleaned);
                    break;
                case 'Encrypted':
                    $result->setEncrypted($valueCleaned == 'yes');
                    break;
                case 'Page size':
                    $valueCleaned = str_replace('pts', '', $valueCleaned);
                    $valueCleaned = preg_replace('/(\(.*\))/', '', $valueCleaned);

                    $valueArray = preg_split('/x/', $valueCleaned);
                    $result->setWidth((int)$valueArray[0]);
                    $result->setHeight((int)$valueArray[1]);
                    break;
                case 'Page rot':
                    $result->setRotation((int)$valueCleaned);
                    break;
                case 'File size':
                    $result->setFileSize((int)$valueCleaned);
                    break;
                case 'Optimized':
                    $result->setLinearized($valueCleaned == 'yes');
                    break;
                case 'PDF version':
                    $result->setPdfVersion($valueCleaned);
                    break;
            }
        }

        return $result;
    }
}
