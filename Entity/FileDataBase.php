<?php
/**
 *
 */

namespace SymfonyContrib\Bundle\FileDataBundle\Entity;

abstract class FileDataBase
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $desc;

    /**
     * File size in bytes.
     *
     * @var int
     */
    protected $size;

    /**
     * @see http://www.freeformatter.com/mime-types-list.html
     *
     * @var string
     */
    protected $mimeType;

    /**
     * Array of arbitrary misc data about the file.
     *
     * @var array
     */
    protected $metaData;

    /**
     * Whether or not this file is on the local file system.
     *
     * @var bool
     */
    protected $local;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var \DateTime
     */
    protected $updated;

    public function __toString()
    {
        return (string)$this->getName();
    }

    public function prePersist()
    {
        $this->desc    = $this->desc ?: '';
        $this->local   = $this->local ?: true;
        $this->created = $this->created ?: \DateTime::createFromFormat('U', $_SERVER['REQUEST_TIME']);
    }

    public function preUpdate()
    {
        $this->updated = \DateTime::createFromFormat('U', $_SERVER['REQUEST_TIME']);
    }


    /* SPLFileInfo Compatibility methods */

    public function getFilename()
    {
        return $this->getName();
    }


    /**
     * @param \DateTime $created
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param array $data
     */
    public function setMetaData(array $data)
    {
        $this->metaData = $data;
    }

    /**
     * @return array
     */
    public function getMetaData()
    {
        return $this->metaData;
    }

    /**
     * @param string $desc
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
    }

    /**
     * @return string
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \DateTime $updated
     */
    public function setUpdated(\DateTime $updated)
    {
        $this->updated = $updated;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param boolean $local
     */
    public function setLocal($local)
    {
        $this->local = (bool)$local;
    }

    /**
     * @return boolean
     */
    public function isLocal()
    {
        return $this->local;
    }

    /**
     * @param string $mimeType
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @param int $size
     */
    public function setSize($size)
    {
        $this->size = (int)$size;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return (int)$this->size;
    }

}
