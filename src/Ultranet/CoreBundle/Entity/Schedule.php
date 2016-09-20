<?php

namespace Ultranet\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Schedule
 *
 * @ORM\Table(name="ultranet_schedule")
 * @ORM\Entity(repositoryClass="Ultranet\CoreBundle\Repository\ScheduleRepository")
 */
class Schedule
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
     * @var \DateTime
     *
     * @ORM\Column(name="startTime", type="time")
     */
    private $startTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endTime", type="time")
     */
    private $endTime;
    
    /**
     * var \boolean
     * 
     * @ORM\Column(name="status", type="boolean")
     */
    private $statusPaiement=false;
    
    /**
     * @var \Datetime
     * 
     * @ORM\Column(name="expired_date", type="datetime")
     */
    private $expiredDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdDate", type="datetime", nullable=true)
     */
    private $createdDate;
    
    /**
     * @var Ultranet\CoreBundle\Entity\Formation
     * 
     * @ORM\ManyToOne(targetEntity="Ultranet\CoreBundle\Entity\Formation", inversedBy="schedules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formation;
    
    /**
     * @var Ultranet\UserBundle\Entity\User
     * 
     * @ORM\ManyToOne(targetEntity="Ultranet\UserBundle\Entity\User", inversedBy="schedules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var UltranetCoreBundle\Entity\Paiement
     * 
     * @ORM\OneToMany(targetEntity="Ultranet\CoreBundle\Entity\Paiement", mappedBy="schedule", cascade={"persist","remove"})
     */
    private $paiements;
   
   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->paiements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->createdDate = new \DateTime;
        $this->expiredDate = new \DateTime() + 5;
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
     * @return Schedule
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
     * Set startTime
     *
     * @param \DateTime $startTime
     *
     * @return Schedule
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     *
     * @return Schedule
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set statusPaiement
     *
     * @param boolean $statusPaiement
     *
     * @return Schedule
     */
    public function setStatusPaiement($statusPaiement)
    {
        $this->statusPaiement = $statusPaiement;

        return $this;
    }

    /**
     * Get statusPaiement
     *
     * @return boolean
     */
    public function getStatusPaiement()
    {
        return $this->statusPaiement;
    }
    
    /**
     * 
     * @return type
     */
    function getExpiredDate() {
        return $this->expiredDate;
    }

    /**
     * 
     * @param \Datetime $expiredDate
     */
    function setExpiredDate(\Datetime $expiredDate) {
        $this->expiredDate = $expiredDate;
    }

    
    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return Schedule
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
     * Set formation
     *
     * @param \Ultranet\CoreBundle\Entity\Formation $formation
     *
     * @return Schedule
     */
    public function setFormation(\Ultranet\CoreBundle\Entity\Formation $formation)
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * Get formation
     *
     * @return \Ultranet\CoreBundle\Entity\Formation
     */
    public function getFormation()
    {
        return $this->formation;
    }

    /**
     * Set user
     *
     * @param \Ultranet\UserBundle\Entity\User $user
     *
     * @return Schedule
     */
    public function setUser(\Ultranet\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ultranet\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add paiement
     *
     * @param \Ultranet\CoreBundle\Entity\Paiement $paiement
     *
     * @return Schedule
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
