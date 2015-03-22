<?php

namespace Phpbr\Bundle\AppBundle\Entity\Forum;

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
     * @var \DateTime
     */
    private $dataCriacao;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $mensagem;

    /**
     * @var \Phpbr\Bundle\AppBundle\Entity\Forum\Categoria
     */
    private $categoria;

    /**
     * @var \Phpbr\Bundle\AppBundle\Entity\User
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->mensagem = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add mensagem
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem $mensagem
     * @return Topico
     */
    public function addMensagem(\Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem $mensagem)
    {
        $this->mensagem[] = $mensagem;

        return $this;
    }

    /**
     * Remove mensagem
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem $mensagem
     */
    public function removeMensagem(\Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem $mensagem)
    {
        $this->mensagem->removeElement($mensagem);
    }

    /**
     * Get mensagem
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMensagem()
    {
        return $this->mensagem;
    }

    /**
     * Set categoria
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\Forum\Categoria $categoria
     * @return Topico
     */
    public function setCategoria(\Phpbr\Bundle\AppBundle\Entity\Forum\Categoria $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \Phpbr\Bundle\AppBundle\Entity\Forum\Categoria 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set user
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\User $user
     * @return Topico
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $nome_mensagem;


    /**
     * Add nome_mensagem
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem $nomeMensagem
     * @return Topico
     */
    public function addNomeMensagem(\Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem $nomeMensagem)
    {
        $this->nome_mensagem[] = $nomeMensagem;

        return $this;
    }

    /**
     * Remove nome_mensagem
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem $nomeMensagem
     */
    public function removeNomeMensagem(\Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem $nomeMensagem)
    {
        $this->nome_mensagem->removeElement($nomeMensagem);
    }

    /**
     * Get nome_mensagem
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNomeMensagem()
    {
        return $this->nome_mensagem;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $topicos;


    /**
     * Add topicos
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem $topicos
     * @return Topico
     */
    public function addTopico(\Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem $topicos)
    {
        $this->topicos[] = $topicos;

        return $this;
    }

    /**
     * Remove topicos
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem $topicos
     */
    public function removeTopico(\Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem $topicos)
    {
        $this->topicos->removeElement($topicos);
    }

    /**
     * Get topicos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTopicos()
    {
        return $this->topicos;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $mensagems;


    /**
     * Get mensagems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMensagems()
    {
        return $this->mensagems;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $mensagens;


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
     * Add mensagens
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem $mensagens
     * @return Topico
     */
    public function addMensagen(\Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem $mensagens)
    {
        $this->mensagens[] = $mensagens;

        return $this;
    }

    /**
     * Remove mensagens
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem $mensagens
     */
    public function removeMensagen(\Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem $mensagens)
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
}
