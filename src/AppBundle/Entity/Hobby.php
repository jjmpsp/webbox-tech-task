<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user_hobbies")
 */
class Hobby
{

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="hobbies")
     * @ORM\JoinColumn(name="hobby_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=2000)
     */
    private $name;

    /**
     * @ORM\Column(type="smallint")
     */
    private $ageStarted;


    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Hobby
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
     * Set ageStarted
     *
     * @param integer $ageStarted
     *
     * @return Hobby
     */
    public function setAgeStarted($ageStarted)
    {
        $this->ageStarted = $ageStarted;

        return $this;
    }

    /**
     * Get ageStarted
     *
     * @return int
     */
    public function getAgeStarted()
    {
        return $this->ageStarted;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }
}

