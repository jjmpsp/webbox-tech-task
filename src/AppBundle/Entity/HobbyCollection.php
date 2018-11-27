<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class HobbyCollection
{
    protected $hobbyCollection;

    public function __construct()
    {
        $this->hobbyCollection = new ArrayCollection();
    }

    public function getHobbyCollection()
    {
        return $this->hobbyCollection;
    }
}