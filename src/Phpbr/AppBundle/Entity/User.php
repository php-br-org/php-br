<?php

namespace Phpbr\AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
    private $articles;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $messages;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $topics;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $events;

    public function __construct() {
        $this->articles = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->topics = new ArrayCollection();
        $this->events = new ArrayCollection();

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
     * Add article
     *
     * @param \Phpbr\AppBundle\Entity\Article $article
     * @return User
     */
    public function addArticle(\Phpbr\AppBundle\Entity\Article $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \Phpbr\AppBundle\Entity\Article $article
     */
    public function removeArticle(\Phpbr\AppBundle\Entity\Article $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Add Message
     *
     * @param \Phpbr\AppBundle\Entity\Forum\Message $message
     *
     * @return User
     */
    public function addMessage(\Phpbr\AppBundle\Entity\Forum\Message $message)
    {
        $this->messages[] = $message;

        return $this;
    }

    /**
     * Remove message
     *
     * @param \Phpbr\AppBundle\Entity\Forum\Message $message
     */
    public function removeMessage(\Phpbr\AppBundle\Entity\Forum\Message $message)
    {
        $this->messages->removeElement($message);
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Add topic
     *
     * @param \Phpbr\AppBundle\Entity\Forum\Topic $topic
     *
     * @return User
     */
    public function addTopic(\Phpbr\AppBundle\Entity\Forum\Topic $topic)
    {
        $this->topics[] = $topic;

        return $this;
    }

    /**
     * Remove topic
     *
     * @param \Phpbr\AppBundle\Entity\Forum\Topic $topic
     */
    public function removeTopic(\Phpbr\AppBundle\Entity\Forum\Topic $topic)
    {
        $this->topics->removeElement($topic);
    }

    /**
     * Add event
     *
     * @param \Phpbr\AppBundle\Entity\Event $event
     *
     * @return User
     */
    public function addEvent(\Phpbr\AppBundle\Entity\Event $event)
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param \Phpbr\AppBundle\Entity\Event $event
     */
    public function removeEvent(\Phpbr\AppBundle\Entity\Event $event)
    {
        $this->topics->removeElement($event);
    }



    /**
     * Get topic
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTopics()
    {
        return $this->topics;
    }

    /**
     * Get event
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents()
    {
        return $this->events;
    }
}
