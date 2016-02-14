<?php

namespace Phpbr\AppBundle\Entity\Interfaces;

/**
 * Interface ColeInterface
 */
interface ColeInterface
{
    public function getId();
    public function setTitulo($titulo);
    public function getTitulo();
    public function setTipo($tipo);
    public function getTipo();
    public function setCodigo($codigo);
    public function getCodigo();
    public function setDataCriacao($dataCriacao);
    public function getDataCriacao();
    public function setChaveDeletar($chaveDeletar);
    public function getChaveDeletar();
}