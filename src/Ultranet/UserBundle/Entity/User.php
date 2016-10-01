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
     * @ORM\OneToOne(targetEntity="Ultranet\UserBundle\Entity\ImageUser", cascade={ "persist", "remove" })
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


   /* public function setEmail($email) {
        if (is_null($this->getUsername())) {
            $this->setUsername(uniqid());
        }
        return parent::setEmail($email);
    }*/

    
}
