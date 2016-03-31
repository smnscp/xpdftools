<?php

namespace Epubli\Pdf\XpdfTools;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

abstract class BaseProcessBuilder
{
    /**
     * @var string Path to executable.
     */
    private $executable;

    /**
     * @var ProcessBuilder
     */
    private $builder;

    /**
     * @var string path to input PDF file
     */
    private $inputFile;

    /**
     * @var string path to output file
     */
    private $outputFile;

    /**
     * @param string $executable
     */
    public function __construct($executable)
    {
        $this->executable = $executable;
        $this->reset();
    }

    /**
     * @return $this
     */
    public function reset()
    {
        $this->builder = new ProcessBuilder();
        $this->builder->setPrefix($this->executable);
        $this->inputFile = null;
        $this->outputFile = null;

        return $this;
    }

    /**
     * @return Process
     */
    public function getProcess()
    {
        if ($this->inputFile) {
            $this->builder->add($this->inputFile);
        }

        if ($this->outputFile) {
            if (!$this->inputFile) {
                // there must be an input file specified before the output file
                $this->builder->add('-');
            }
            $this->builder->add($this->outputFile);
        }

        return $this->builder->getProcess();
    }

    /**
     * Set the path to the PDF file.
     *
     * @param string $path path to PDF file
     * @return $this
     */
    public function setInputFile($path)
    {
        $this->inputFile = $path;

        return $this;
    }

    /**
     * Let Xpdf tools expect input from stdin.
     *
     * @return $this
     */
    public function setInputStdin()
    {
        return $this->setInputFile('-');
    }

    /**
     * Let Xpdf tools read $input from stdin.
     *
     * @param string $input PDF byte string coming from stdin
     * @return $this
     */
    public function setInput($input)
    {
        $this->builder->setInput($input);

        return $this->setInputStdin();
    }

    /**
     * Set the path to the output file.
     * This can be a single file (pdftops, pdftotext) or a path prefix (pdfimages, pdftohtml, pdftoppm).
     *
     * @param string $path path to output file
     * @return $this
     */
    public function setOutputFile($path)
    {
        $this->outputFile = $path;

        return $this;
    }

    /**
     * Set stdout as output.
     *
     * @return $this
     */
    public function setOutputStdout()
    {
        return $this->setOutputFile('-');
    }

    #region Options
    /**
     * Set the first page to process
     * 
     * @param int $num page number
     * @return $this
     */
    public function setFirstPage($num)
    {
        return $this->setOption('f', $num);
    }

    /**
     * Set the last page to process
     * 
     * @param int $num page number
     * @return $this
     */
    public function setLastPage($num)
    {
        return $this->setOption('l', $num);
    }

    /**
     * Don’t print any messages or errors
     *
     * @return $this
     */
    public function setQuiet()
    {
        return $this->setOption('q');
    }

    /**
     * Print copyright and version info
     *
     * @return $this
     */
    public function setPrintInfo()
    {
        return $this->setOption('v');
    }

    /**
     * Print usage information
     *
     * @return $this
     */
    public function setPrintHelp()
    {
        return $this->setOption('h');
    }

    /**
     * Set a command line option with name $option.
     * 
     * @param string $option name of the command line option (w/o dash)
     * @return $this
     */
    protected function setOption($option, $value = null)
    {
        $this->builder->add('-'.$option);
        if (!is_null($value)) {
            $this->builder->add($value);
        }
        
        return $this;
    }
    #endregion Options
}
