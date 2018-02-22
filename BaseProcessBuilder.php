<?php

namespace Epubli\Pdf\XpdfTools;

abstract class BaseProcessBuilder extends \Epubli\Process\BaseProcessBuilder
{
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
}
