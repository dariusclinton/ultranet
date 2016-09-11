<?php

namespace Ultranet\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Ultranet\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="subnames", type="string", length=255, nullable=true)
     */
    protected $subnames;

    /**
     * @var date
     *
     * @ORM\Column(name="bird_day_date", type="date", nullable=true)
     */
    protected $birdayDate;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneNumber", type="string", length=255, nullable=true)
     */
    protected $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(name="quarter", type="string", length=255, nullable=true)
     */
    protected $quarter;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=true)
     */
    protected $slug;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
    }

    public function setEmail($email) {
        parent::setEmail($email);
        $this->setUsername($email);
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set subnames
     *
     * @param string $subnames
     *
     * @return User
     */
    public function setSubnames($subnames) {
        $this->subnames = $subnames;

        return $this;
    }

    /**
     * Get subnames
     *
     * @return string
     */
    public function getSubnames() {
        return $this->subnames;
    }

    /**
     * Set birdayDate
     *
     * @param \DateTime $birdayDate
     *
     * @return User
     */
    public function setBirdayDate($birdayDate) {
        $this->birdayDate = $birdayDate;

        return $this;
    }

    /**
     * Get birdayDate
     *
     * @return \DateTime
     */
    public function getBirdayDate() {
        return $this->birdayDate;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return User
     */
    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return User
     */
    public function setCity($city) {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * Set quarter
     *
     * @param string $quarter
     *
     * @return User
     */
    public function setQuarter($quarter) {
        $this->quarter = $quarter;

        return $this;
    }

    /**
     * Get quarter
     *
     * @return string
     */
    public function getQuarter() {
        return $this->quarter;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return User
     */
    public function setSlug($slug) {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }

}
