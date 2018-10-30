<?php

namespace Epubli\Pdf\XpdfTools;

class PdfToHtmlProcessBuilder extends BaseProcessBuilder
{
    public function __construct($prefix = '', $executable = 'pdftohtml')
    {
        parent::__construct($prefix.$executable);
    }

    /**
     * Override method because pdftohtml does not support this!
     *
     * @param string $input PDF byte string coming from stdin
     * @return $this|void
     * @throws Exception pdftohtml does not support input via stdin.
     */
    public function setInput($input)
    {
        throw new Exception('pdftohtml does not support input via stdin.');
    }

    /**
     * Set stdout as output.
     *
     * pdftohtml behaves a little different than its siblings, as in a terminal dash would be considered the file name
     * prefix for the HTML/XML output files.
     *
     * @return $this
     */
    public function setOutputStdout()
    {
        return $this->setOption('stdout');
    }
}
