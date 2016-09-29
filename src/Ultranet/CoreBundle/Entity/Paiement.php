<?php

namespace Ultranet\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paiement
 *
 * @ORM\Table(name="ultranet_paiement")
 * @ORM\Entity(repositoryClass="Ultranet\CoreBundle\Repository\PaiementRepository")
 */
class Paiement
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
     * @ORM\Column(name="mode", type="string", length=255)
     */
    private $mode;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    
    /**
     * @var \UltranetCoreBundle\Entity\Schedule
     * 
     * @ORM\ManyToOne(targetEntity="Ultranet\CoreBundle\Entity\Schedule", inversedBy="paiements")
     */
    private $schedule;
    
    /**
     * @var \UltranetUserBundle\Entity\User
     * 
     * @ORM\ManyToOne(targetEntity="Ultranet\UserBundle\Entity\User", inversedBy="paiements")
     */
    private  $user;


    public function __construct() {
       $this->date = new \DateTime;
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
     * Set mode
     *
     * @param string $mode
     *
     * @return Paiement
     */
    public function setMode($mode)
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * Get mode
     *
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Paiement
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Paiement
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set schedule
     *
     * @param \Ultranet\CoreBundle\Entity\Schedule $schedule
     *
     * @return Paiement
     */
    public function setSchedule(\Ultranet\CoreBundle\Entity\Schedule $schedule = null)
    {
        $this->schedule = $schedule;

        return $this;
    }

    /**
     * Get schedule
     *
     * @return \Ultranet\CoreBundle\Entity\Schedule
     */
    public function getSchedule()
    {
        return $this->schedule;
    }

    /**
     * Set user
     *
     * @param \Ultranet\UserBundle\Entity\User $user
     *
     * @return Paiement
     */
    public function setUser(\Ultranet\UserBundle\Entity\User $user = null)
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
}
