<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{

    /**
     * @ORM\OneToMany(targetEntity="Hobby", mappedBy="user")
     */
    private $hobbies;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string",length=200)
     */
    protected $fullName;

    /**
     * @ORM\Column(type="string",length=2000,nullable=true)
     */
    protected $biography;

    /**
     * @ORM\Column(type="date")
     */
    protected $dateOfBirth;

    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    protected $profileImage;

    public function __construct()
    {
        parent::__construct();

        $this->hobbies = new ArrayCollection();
    }

    public function getFullName(): ? string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName)
    {
        $this->fullName = $fullName;
    }

    public function getDateOfBirth(): ? \DateTime
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTime $dateOfBirth = null)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getBiography(): ? string
    {
        return $this->biography;
    }

    public function setBiography(string $biography)
    {
        $this->biography = $biography;
    }

    public function getProfileImage(): ? string
    {
        return $this->profileImage;
    }

    public function setProfileImage(string $profileImage)
    {
        $this->profileImage = $profileImage;
    }

    public function getHobbies()
    {
        return $this->hobbies;
    }

    public function setHobbies($hobbies): void
    {
        $this->hobbies = $hobbies;
    }
}