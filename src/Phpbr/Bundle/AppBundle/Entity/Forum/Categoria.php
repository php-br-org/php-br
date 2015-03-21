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
     * @var boolean
     */
    private $status;

    /**
     * @var \DateTime
     */
    private $dataCriacao;


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
     * Set categoria
     *
     * @param string $categoria
     * @return Categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string 
     */
    public function getCategoria()
    {
        return $this->categoria;
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
     * @var string
     */
    private $descricao;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $categoria;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categoria = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add categoria
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\Forum\Topico $categoria
     * @return Categoria
     */
    public function addCategoria(\Phpbr\Bundle\AppBundle\Entity\Forum\Topico $categoria)
    {
        $this->categoria[] = $categoria;

        return $this;
    }

    /**
     * Remove categoria
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\Forum\Topico $categoria
     */
    public function removeCategoria(\Phpbr\Bundle\AppBundle\Entity\Forum\Topico $categoria)
    {
        $this->categoria->removeElement($categoria);
    }
}
