<?php

namespace Phpbr\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Phpbr\AppBundle\Entity\Interfaces\PasteInterface;

/**
 * Paste
 */
class Paste implements PasteInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $code;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $deleteKey;


    public function __construct()
    {
        $this->setDataCriacao(new \DateTime());
        $this->setChaveDeletar(uniqid());
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Paste
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Paste
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Paste
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Paste
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set deleteKey
     *
     * @param string $deleteKey
     * @return Paste
     */
    public function setDeleteKey($deleteKey)
    {
        $this->deleteKey = $deleteKey;

        return $this;
    }

    /**
     * Get deleteKey
     *
     * @return string 
     */
    public function getDeleteKey()
    {
        return $this->deleteKey;
    }
}
