<?php

namespace Phpbr\AppBundle\Entity;

/**
 * Irc
 */
class Irc
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nicks;

    /**
     * @var string
     */
    private $updatedAt;

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
     * Set nicks
     *
     * @param string $nicks
     *
     * @return Irc
     */
    public function setNicks($nicks)
    {
        $this->nicks = $nicks;
        $this->setUpdatedAt(new \DateTime());

        return $this;
    }

    /**
     * Get nicks
     *
     * @return string
     */
    public function getNicks()
    {
        return $this->nicks;
    }


    /**
     * Set updatedAt
     *
     * @param DateTime $updatedAt
     *
     * @return irc
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}


