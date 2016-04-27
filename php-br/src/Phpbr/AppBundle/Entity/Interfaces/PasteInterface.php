<?php

namespace Phpbr\AppBundle\Entity\Interfaces;

/**
 * Interface PasteInterface
 */
interface PasteInterface
{
    public function getId();
    public function setTitle($title);
    public function getTitle();
    public function setType($type);
    public function getType();
    public function setCode($code);
    public function getCode();
    public function setCreatedAt($createdAt);
    public function getCreatedAt();
    public function setDeleteKey($deleteKey);
    public function getDeleteKey();
}