<?php

namespace Phpbr\Bundle\AppBundle\Entity\Forum;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 */
class Categoria
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nome;

    /**
     * @var string
     */
    private $descricao;

    /**
     * @var boolean
     */
    private $status;

    /**
     * @var \DateTime
     */
    private $dataCriacao;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $topicos;

    /**
     * @var string
     */
    private $slug;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->topicos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nome
     *
     * @param string $nome
     * @return Categoria
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     * @return Categoria
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string 
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Categoria
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set dataCriacao
     *
     * @param \DateTime $dataCriacao
     * @return Categoria
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
     * Add topicos
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\Forum\Topico $topicos
     * @return Categoria
     */
    public function addTopico(\Phpbr\Bundle\AppBundle\Entity\Forum\Topico $topicos)
    {
        $this->topicos[] = $topicos;

        return $this;
    }

    /**
     * Remove topicos
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\Forum\Topico $topicos
     */
    public function removeTopico(\Phpbr\Bundle\AppBundle\Entity\Forum\Topico $topicos)
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
}
