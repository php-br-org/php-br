<?php

namespace Phpbr\AppBundle\Entity\Forum;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topico
 */
class Topico
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $assunto;

    /**
     * @var string
     */
    private $mensagem;

    /**
     * @var \DateTime
     */
    private $dataCriacao;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $mensagens;

    /**
     * @var \Phpbr\AppBundle\Entity\Forum\Categoria
     */
    private $categoria;

    /**
     * @var \Phpbr\AppBundle\Entity\User
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->mensagens = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set assunto
     *
     * @param string $assunto
     * @return Topico
     */
    public function setAssunto($assunto)
    {
        $this->assunto = $assunto;

        return $this;
    }

    /**
     * Get assunto
     *
     * @return string 
     */
    public function getAssunto()
    {
        return $this->assunto;
    }

    /**
     * Set mensagem
     *
     * @param string $mensagem
     * @return Topico
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
     * @return Topico
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
     * Set slug
     *
     * @param string $slug
     * @return Topico
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add mensagens
     *
     * @param \Phpbr\AppBundle\Entity\Forum\Mensagem $mensagens
     * @return Topico
     */
    public function addMensagen(\Phpbr\AppBundle\Entity\Forum\Mensagem $mensagens)
    {
        $this->mensagens[] = $mensagens;

        return $this;
    }

    /**
     * Remove mensagens
     *
     * @param \Phpbr\AppBundle\Entity\Forum\Mensagem $mensagens
     */
    public function removeMensagen(\Phpbr\AppBundle\Entity\Forum\Mensagem $mensagens)
    {
        $this->mensagens->removeElement($mensagens);
    }

    /**
     * Get mensagens
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMensagens()
    {
        return $this->mensagens;
    }

    /**
     * Set categoria
     *
     * @param \Phpbr\AppBundle\Entity\Forum\Categoria $categoria
     * @return Topico
     */
    public function setCategoria(\Phpbr\AppBundle\Entity\Forum\Categoria $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \Phpbr\AppBundle\Entity\Forum\Categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set user
     *
     * @param \Phpbr\AppBundle\Entity\User $user
     * @return Topico
     */
    public function setUser(\Phpbr\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Phpbr\AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
