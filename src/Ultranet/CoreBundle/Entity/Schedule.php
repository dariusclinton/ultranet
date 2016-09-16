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
    * @var Ultranet\CoreBundle\Entity\Level
    * 
    * @ORM\ManyToOne(targetEntity="Ultranet\CoreBundle\Entity\Level", inversedBy="schedules")
    * @ORM\JoinColumn(nullable=false)
    */
    private $level;

    

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
     * Set level
     *
     * @param \Ultranet\CoreBundle\Entity\Level $level
     *
     * @return Schedule
     */
    public function setLevel(\Ultranet\CoreBundle\Entity\Level $level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return \Ultranet\CoreBundle\Entity\Level
     */
    public function getLevel()
    {
        return $this->level;
    }
}
