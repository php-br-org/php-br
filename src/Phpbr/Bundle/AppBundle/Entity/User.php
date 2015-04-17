<?php

namespace Phpbr\Bundle\AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $linkedin;

    /**
     * @var string
     */
    protected $twitter;

    /**
     * @var string
     */
    protected $github;

    /**
     * @var string
     */
    protected $facebook_id;

    /**
     * @var string
     */
    protected $facebook_access_token;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $artigos;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $mensagens;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $topicos;

    
    public function __construct() {
        $this->artigos = new ArrayCollection();
        $this->mensagens = new ArrayCollection();
        $this->topicos = new ArrayCollection();

        parent::__construct();
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
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     * @return User
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set linkedin
     *
     * @param string $linkedin
     * @return User
     */
    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;

        return $this;
    }



    /**
     * Get linkedin
     *
     * @return string
     */
    public function getLinkedin()
    {
        return $this->linkedin;
    }


    /**
     * Set github
     *
     * @param string $github
     * @return User
     */
    public function setGithub($github)
    {
        $this->github = $github;

        return $this;
    }

    /**
     * Get github
     *
     * @return string
     */
    public function getGithub()
    {
        return $this->github;
    }


    /**
     * Set facebook_id
     *
     * @param string $facebookId
     * @return User
     */
    public function setFacebookId($facebookId)
    {
        $this->facebook_id = $facebookId;

        return $this;
    }

    /**
     * Get facebook_id
     *
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    /**
     * Set facebook_access_token
     *
     * @param string $facebookAccessToken
     * @return User
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebook_access_token = $facebookAccessToken;

        return $this;
    }

    /**
     * Get facebook_access_token
     *
     * @return string
     */
    public function getFacebookAccessToken()
    {
        return $this->facebook_access_token;
    }

    /**
     * Add artigos
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\Artigo $artigos
     * @return User
     */
    public function addArtigo(\Phpbr\Bundle\AppBundle\Entity\Artigo $artigos)
    {
        $this->artigos[] = $artigos;

        return $this;
    }

    /**
     * Remove artigos
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\Artigo $artigos
     */
    public function removeArtigo(\Phpbr\Bundle\AppBundle\Entity\Artigo $artigos)
    {
        $this->artigos->removeElement($artigos);
    }

    /**
     * Get artigos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArtigos()
    {
        return $this->artigos;
    }

    /**
     * Add mensagen
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem $mensagen
     *
     * @return User
     */
    public function addMensagen(\Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem $mensagen)
    {
        $this->mensagens[] = $mensagen;

        return $this;
    }

    /**
     * Remove mensagen
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem $mensagen
     */
    public function removeMensagen(\Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem $mensagen)
    {
        $this->mensagens->removeElement($mensagen);
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
     * Add topico
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\Forum\Topico $topico
     *
     * @return User
     */
    public function addTopico(\Phpbr\Bundle\AppBundle\Entity\Forum\Topico $topico)
    {
        $this->topicos[] = $topico;

        return $this;
    }

    /**
     * Remove topico
     *
     * @param \Phpbr\Bundle\AppBundle\Entity\Forum\Topico $topico
     */
    public function removeTopico(\Phpbr\Bundle\AppBundle\Entity\Forum\Topico $topico)
    {
        $this->topicos->removeElement($topico);
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
}
