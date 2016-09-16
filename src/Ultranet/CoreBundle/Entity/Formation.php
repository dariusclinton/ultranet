<?php

namespace Ultranet\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formation
 *
 * @ORM\Table(name="ultranet_formation")
 * @ORM\Entity(repositoryClass="Ultranet\CoreBundle\Repository\FormationRepository")
 */
class Formation {

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
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="presentation", type="text", nullable=true)
     */
    private $presentation;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="text", nullable=true)
     */
    private $slug;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdDate", type="datetime", nullable=true)
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
     * @var Ultranet\CoreBundle\Entity\Level
     * 
     * @ORM\ManyToMany(targetEntity="Ultranet\CoreBundle\Entity\Level", inversedBy="formations")
     * @ORM\JoinTable(name="ultranet_formation_level")
     */
    private $levels;
    
    /**
     * @var Ultranet\CoreBundle\Entity\Schedule
     * 
     * @ORM\OneToMany(targetEntity="Ultranet\CoreBundle\Entity\Schedule", mappedBy="formation", cascade={"persist","remove"})
     */
    private $schedules;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->levels = new \Doctrine\Common\Collections\ArrayCollection();
        $this->schedules = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Formation
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
     * Set description
     *
     * @param string $description
     *
     * @return Formation
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set presentation
     *
     * @param string $presentation
     *
     * @return Formation
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;

        return $this;
    }

    /**
     * Get presentation
     *
     * @return string
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Formation
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return Formation
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
     * Set image
     *
     * @param \Ultranet\UserBundle\Entity\Image $image
     *
     * @return Formation
     */
    public function setImage(\Ultranet\UserBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Ultranet\UserBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add level
     *
     * @param \Ultranet\CoreBundle\Entity\Level $level
     *
     * @return Formation
     */
    public function addLevel(\Ultranet\CoreBundle\Entity\Level $level)
    {
        $this->levels[] = $level;

        return $this;
    }

    /**
     * Remove level
     *
     * @param \Ultranet\CoreBundle\Entity\Level $level
     */
    public function removeLevel(\Ultranet\CoreBundle\Entity\Level $level)
    {
        $this->levels->removeElement($level);
    }

    /**
     * Get levels
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLevels()
    {
        return $this->levels;
    }

    /**
     * Add schedule
     *
     * @param \Ultranet\CoreBundle\Entity\Schedule $schedule
     *
     * @return Formation
     */
    public function addSchedule(\Ultranet\CoreBundle\Entity\Schedule $schedule)
    {
        $this->schedules[] = $schedule;

        return $this;
    }

    /**
     * Remove schedule
     *
     * @param \Ultranet\CoreBundle\Entity\Schedule $schedule
     */
    public function removeSchedule(\Ultranet\CoreBundle\Entity\Schedule $schedule)
    {
        $this->schedules->removeElement($schedule);
    }

    /**
     * Get schedules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSchedules()
    {
        return $this->schedules;
    }
}
