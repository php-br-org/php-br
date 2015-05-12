<?php

namespace Phpbr\Bundle\AppBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Phpbr\Bundle\AppBundle\Entity\Event;

/**
 * Class EventService
 */
class EventService
{

    public $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Get Repository
     *
     * @return Event
     */
    public function repository()
    {
        $article = $this->em->getRepository('PhpbrAppBundle:Event');

        return $article;
    }

    /**
     * Persist and flush event
     *
     * @param Event $entity
     * @return Event
     */
    public function insert(Event $entity)
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * Remove Event
     *
     * @param Event $event
     * @return Event
     */
    public function remove(Event $event)
    {
        $this->em->remove($event);
        $this->em->flush();

        return $event;
    }

    /**
     * Find all event
     *
     * @return array
     */
    public function findAll()
    {
        $event = $this->repository()->findAll();

        return $event;
    }

    /**
     * Find Event
     *
     * @param int $id
     * @return Event
     */
    public function findByEvent($id)
    {
        $id = $this->repository()->find([
            'id' => $id
        ]);

        return $id;
    }
}
