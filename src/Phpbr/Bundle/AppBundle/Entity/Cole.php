<?php

namespace Phpbr\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Phpbr\Bundle\AppBundle\Entity\Interfaces\ColeInterface;

/**
 * Cole
 */
class Cole implements ColeInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $titulo;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var string
     */
    private $codigo;

    /**
     * @var \DateTime
     */
    private $dataCriacao;

    /**
     * @var string
     */
    private $chaveDeletar;


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
     * Set titulo
     *
     * @param string $titulo
     * @return Cole
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Cole
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return Cole
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set dataCriacao
     *
     * @param \DateTime $dataCriacao
     * @return Cole
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
     * Set chaveDeletar
     *
     * @param string $chaveDeletar
     * @return Cole
     */
    public function setChaveDeletar($chaveDeletar)
    {
        $this->chaveDeletar = $chaveDeletar;

        return $this;
    }

    /**
     * Get chaveDeletar
     *
     * @return string 
     */
    public function getChaveDeletar()
    {
        return $this->chaveDeletar;
    }
}
