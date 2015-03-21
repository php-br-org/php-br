<?php

namespace Phpbr\Bundle\AppBundle\Entity\Forum;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mensagem
 */
class Mensagem
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $mensagem;

    /**
     * @var \DateTime
     */
    private $dataCriacao;

    /**
     * @var \Phpbr\Bundle\AppBundle\Entity\Forum\Topico
     */
    private $topico;

    /**
     * @var \Phpbr\Bundle\AppBundle\Entity\User
     */
    private $user;


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
     * Set mensagem
     *
     * @param string $mensagem
     * @return Mensagem
     */
    public function setMensagem($mensagem)
    {
        $this->mensagem = $mensagem;

        return $this;
    }

    /**
     * Get mensagem
     *
     * @return string 
     */
    public function getMensagem()
    {
        return $this->mensagem;
    }

    /**
     * Set dataCriacao
     *
     * @param \DateTime $dataCriacao
     * @return Mensagem
     */
    public function setDataCriacao($dataCriacao)
    {
        $this->dataCriacao = $dataCriacao;

        return $this;
    }

    /**
     * Get dataCriacao
     *
     * @return \DateTime 
     */
    public function getDataCriacao()
    {
        return $this->dataCriacao;
    }

    /**
     * Set topico
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\Forum\Topico $topico
     * @return Mensagem
     */
    public function setTopico(\Phpbr\Bundle\AppBundle\Entity\Forum\Topico $topico = null)
    {
        $this->topico = $topico;

        return $this;
    }

    /**
     * Get topico
     *
     * @return \Phpbr\Bundle\AppBundle\Entity\Forum\Topico 
     */
    public function getTopico()
    {
        return $this->topico;
    }

    /**
     * Set user
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\User $user
     * @return Mensagem
     */
    public function setUser(\Phpbr\Bundle\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Phpbr\Bundle\AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
