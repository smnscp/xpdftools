<?php

namespace Epubli\Pdf\XpdfTools;

class PdfInfoParserResult
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $keywords;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $creator;

    /**
     * @var string
     */
    private $producer;

    /**
     * @var \DateTime
     */
    private $creationDate;

    /**
     * @var \DateTime
     */
    private $modificationDate;

    /**
     * @var bool
     */
    private $tagged;

    /**
     * @var bool
     */
    private $userProperties;

    /**
     * @var bool
     */
    private $suspects;

    /**
     * @var string
     */
    private $form;

    /**
     * @var bool
     */
    private $javaScript;

    /**
     * @var int
     */
    private $pagesTotal;

    /**
     * @var bool
     */
    private $encrypted;

    /**
     * @var string
     */
    private $permissions;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @var int
     */
    private $rotation;

    /**
     * @var int
     */
    private $fileSize;

    /**
     * @var bool
     */
    private $linearized;

    /**
     * @var string
     */
    private $pdfVersion;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param string $keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param string $creator
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;
    }

    /**
     * @return string
     */
    public function getProducer()
    {
        return $this->producer;
    }

    /**
     * @param string $producer
     */
    public function setProducer($producer)
    {
        $this->producer = $producer;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return \DateTime
     */
    public function getModificationDate()
    {
        return $this->modificationDate;
    }

    /**
     * @param \DateTime $modificationDate
     */
    public function setModificationDate($modificationDate)
    {
        $this->modificationDate = $modificationDate;
    }

    /**
     * @return boolean
     */
    public function isTagged()
    {
        return $this->tagged;
    }

    /**
     * @param boolean $tagged
     */
    public function setTagged($tagged)
    {
        $this->tagged = $tagged;
    }

    /**
     * @return boolean
     */
    public function hasUserProperties()
    {
        return $this->userProperties;
    }

    /**
     * @param boolean $userProperties
     */
    public function setUserProperties($userProperties)
    {
        $this->userProperties = $userProperties;
    }

    /**
     * @return boolean
     */
    public function hasSuspects()
    {
        return $this->suspects;
    }

    /**
     * @param boolean $suspects
     */
    public function setSuspects($suspects)
    {
        $this->suspects = $suspects;
    }

    /**
     * @return string
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param string $form
     */
    public function setForm($form)
    {
        $this->form = $form;
    }

    /**
     * @return boolean
     */
    public function hasJavaScript()
    {
        return $this->javaScript;
    }

    /**
     * @param boolean $javaScript
     */
    public function setJavaScript($javaScript)
    {
        $this->javaScript = $javaScript;
    }

    /**
     * @return int
     */
    public function getPagesTotal()
    {
        return $this->pagesTotal;
    }

    /**
     * @param int $pagesTotal
     */
    public function setPagesTotal($pagesTotal)
    {
        $this->pagesTotal = $pagesTotal;
    }

    /**
     * @return boolean
     */
    public function isEncrypted()
    {
        return $this->encrypted;
    }

    /**
     * @param boolean $encrypted
     */
    public function setEncrypted($encrypted)
    {
        $this->encrypted = $encrypted;
    }

    /**
     * @return string
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @param string $permissions
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getRotation()
    {
        return $this->rotation;
    }

    /**
     * @param int $rotation
     */
    public function setRotation($rotation)
    {
        $this->rotation = $rotation;
    }

    /**
     * @return int
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * @param int $fileSize
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;
    }

    /**
     * @return boolean
     */
    public function isLinearized()
    {
        return $this->linearized;
    }

    /**
     * @param boolean $linearized
     */
    public function setLinearized($linearized)
    {
        $this->linearized = $linearized;
    }

    /**
     * @return string
     */
    public function getPdfVersion()
    {
        return $this->pdfVersion;
    }

    /**
     * @param string $pdfVersion
     */
    public function setPdfVersion($pdfVersion)
    {
        $this->pdfVersion = $pdfVersion;
    }
}
