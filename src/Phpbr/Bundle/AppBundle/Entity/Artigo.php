<?php

namespace Phpbr\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Artigo
 */
class Artigo
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
    private $tags;

    /**
     * @var string
     */
    private $resumo;

    /**
     * @var string
     */
    private $texto;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var integer
     */
    private $score;

    /**
     * @var boolean
     */
    private $publicado;

    /**
     * @var boolean
     */
    private $aprovado;

    /**
     * @var \DateTime
     */
    private $dataPublicado;

    /**
     * @var \DateTime
     */
    private $dataAtualizado;

    /**
     * @var \Phpbr\Bundle\AppBundle\Entity\User
     */
    private $user;


    public function __construct()
    {
        $this->dataPublicado = new \DateTime();
        $this->publicado = false;
        $this->score = 0;
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
     * @return Artigo
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
     * Set tags
     *
     * @param string $tags
     * @return Artigo
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * Get tags
     *
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set resumo
     *
     * @param string $resumo
     * @return Artigo
     */
    public function setResumo($resumo)
    {
        $this->resumo = $resumo;

        return $this;
    }

    /**
     * Get resumo
     *
     * @return string 
     */
    public function getResumo()
    {
        return $this->resumo;
    }

    /**
     * Set texto
     *
     * @param string $texto
     * @return Artigo
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string 
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Artigo
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
     * Set score
     *
     * @param integer $score
     * @return Artigo
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set publicado
     *
     * @param boolean $publicado
     * @return Artigo
     */
    public function setPublicado($publicado)
    {
        $this->publicado = $publicado;

        return $this;
    }

    /**
     * Get publicado
     *
     * @return boolean 
     */
    public function getPublicado()
    {
        return $this->publicado;
    }


    /**
     * Set aprovado
     *
     * @param boolean $aprovado
     * @return Artigo
     */
    public function setAprovado($aprovado)
    {
        $this->aprovado = $aprovado;

        return $this;
    }

    /**
     * Get aprovado
     *
     * @return boolean 
     */
    public function getAprovado()
    {
        return $this->aprovado;
    }


    /**
     * Set dataPublicado
     *
     * @param \DateTime $dataPublicado
     * @return Artigo
     */
    public function setDataPublicado($dataPublicado)
    {
        $this->dataPublicado = $dataPublicado;

        return $this;
    }

    /**
     * Get dataPublicado
     *
     * @return \DateTime 
     */
    public function getDataPublicado()
    {
        return $this->dataPublicado;
    }

    /**
     * Set dataAtualizado
     *
     * @param \DateTime $dataAtualizado
     * @return Artigo
     */
    public function setDataAtualizado($dataAtualizado)
    {
        $this->dataAtualizado = $dataAtualizado;

        return $this;
    }

    /**
     * Get dataAtualizado
     *
     * @return \DateTime 
     */
    public function getDataAtualizado()
    {
        return $this->dataAtualizado;
    }

    /**
     * Set user
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\User $user
     * @return Artigo
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
