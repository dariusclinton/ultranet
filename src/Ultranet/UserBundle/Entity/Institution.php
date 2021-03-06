<?php

namespace Ultranet\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Institution
 *
 * @ORM\Table(name="ultranet_institution")
 * @ORM\Entity(repositoryClass="Ultranet\UserBundle\Repository\InstitutionRepository")
 */
class Institution
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="quarter", type="string", length=255, nullable=true)
     */
    private $quarter;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_validate", type="boolean", nullable=true)
     */
    private $isValidate = false;

    /**
     * @var \Datetime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     */
    private $createdDate;
    
    /**
     * @var Ultranet\UserBundle\Entity\User
     * 
     * @ORM\OneToMany(targetEntity="Ultranet\UserBundle\Entity\User", mappedBy="institution")
     */
    private $users;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
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
     *
     * @return Institution
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
     * Set city
     *
     * @param string $city
     *
     * @return Institution
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set quarter
     *
     * @param string $quarter
     *
     * @return Institution
     */
    public function setQuarter($quarter)
    {
        $this->quarter = $quarter;

        return $this;
    }

    /**
     * Get quarter
     *
     * @return string
     */
    public function getQuarter()
    {
        return $this->quarter;
    }
    

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return Institution
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Add user
     *
     * @param \Ultranet\UserBundle\Entity\User $user
     *
     * @return Institution
     */
    public function addUser(\Ultranet\UserBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Ultranet\UserBundle\Entity\User $user
     */
    public function removeUser(\Ultranet\UserBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

   

    /**
     * Set isValidate
     *
     * @param boolean $isValidate
     *
     * @return Institution
     */
    public function setIsValidate($isValidate)
    {
        $this->isValidate = $isValidate;

        return $this;
    }

    /**
     * Get isValidate
     *
     * @return boolean
     */
    public function getIsValidate()
    {
        return $this->isValidate;
    }
}
