<?php

namespace Ultranet\UserBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use FOS\UserBundle\Model\UserInterface;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * User
 *
 * @ORM\Table(name="ultranet_user")
 * @ORM\Entity(repositoryClass="Ultranet\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser implements UserInterface {

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
     * @var \Datetime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     */
    private $createdDate;

    /**
     * @var Ultranet\UserBundle\Entity\Image
     * 
     * @ORM\OneToOne(targetEntity="Ultranet\UserBundle\Entity\Image", cascade={ "persist", "remove" })
     * @ORM\JoinColumn(nullable=true)
     */
    protected $image;

    /**
     * @var Ultranet\UserBundle\Entity\Institution
     * 
     * @ORM\ManyToOne(targetEntity="Ultranet\UserBundle\Entity\Institution", inversedBy="users")
     */
    protected $institution;

    /**
     * @var Ultranet\CoreBundle\Entity\Schedule
     * 
     * @ORM\OneToMany(targetEntity="Ultranet\CoreBundle\Entity\Schedule", mappedBy="user", cascade={"persist","remove"})
     */
    protected $schedules;
    
    /**
     * @var \UltranetCoreBundle\Entity\Paiement
     * 
     * @ORM\OneToMany(targetEntity="Ultranet\CoreBundle\Entity\Paiement", mappedBy="user", cascade={"persist","remove"})
     */
    protected $paiements;

    public function __construct() {
        parent::__construct();
        $this->schedules = new \Doctrine\Common\Collections\ArrayCollection();
    }

   /* public function setEmail($email) {
        if (is_null($this->getUsername())) {
            $this->setUsername(uniqid());
        }
        return parent::setEmail($email);
    }*/

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
     * Set image
     *
     * @param \Ultranet\UserBundle\Entity\Image $image
     *
     * @return User
     */
    public function setImage(\Ultranet\UserBundle\Entity\Image $image = null) {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Ultranet\UserBundle\Entity\Image
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Set institution
     *
     * @param \Ultranet\UserBundle\Entity\Institution $institution
     *
     * @return User
     */
    public function setInstitution(\Ultranet\UserBundle\Entity\Institution $institution = null) {
        $this->institution = $institution;

        return $this;
    }

    /**
     * Get institution
     *
     * @return \Ultranet\UserBundle\Entity\Institution
     */
    public function getInstitution() {
        return $this->institution;
    }

    /**
     * Add schedule
     *
     * @param \Ultranet\CoreBundle\Entity\Schedule $schedule
     *
     * @return User
     */
    public function addSchedule(\Ultranet\CoreBundle\Entity\Schedule $schedule) {
        $this->schedules[] = $schedule;

        return $this;
    }

    /**
     * Remove schedule
     *
     * @param \Ultranet\CoreBundle\Entity\Schedule $schedule
     */
    public function removeSchedule(\Ultranet\CoreBundle\Entity\Schedule $schedule) {
        $this->schedules->removeElement($schedule);
    }

    /**
     * Get schedules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSchedules() {
        return $this->schedules;
    }


    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return User
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
     * Add paiement
     *
     * @param \Ultranet\CoreBundle\Entity\Paiement $paiement
     *
     * @return User
     */
    public function addPaiement(\Ultranet\CoreBundle\Entity\Paiement $paiement)
    {
        $this->paiements[] = $paiement;

        return $this;
    }

    /**
     * Remove paiement
     *
     * @param \Ultranet\CoreBundle\Entity\Paiement $paiement
     */
    public function removePaiement(\Ultranet\CoreBundle\Entity\Paiement $paiement)
    {
        $this->paiements->removeElement($paiement);
    }

    /**
     * Get paiements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPaiements()
    {
        return $this->paiements;
    }
}
