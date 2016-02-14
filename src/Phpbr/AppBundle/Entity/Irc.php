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
    private $dataAtualizado;



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
        $this->setDataAtualizado(new \DateTime());

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
     * Set dataAtualizado
     *
     * @param DateTime $dataAtualizado
     *
     * @return irc
     */
    public function setDataAtualizado($dataAtualizado)
    {
        $this->dataAtualizado = $dataAtualizado;

        return $this;
    }

    /**
     * Get dataAtualizado
     *
     * @return DateTime
     */
    public function getDataAtualizado()
    {
        return $this->dataAtualizado;
    }
}


