<?php

namespace Ultranet\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Image
 *
 * @ORM\Table(name="ultranet_image_user")
 * @ORM\Entity(repositoryClass="Ultranet\UserBundle\Repository\ImageUserRepository")
 * @Vich\Uploadable
 */
class ImageUser
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;


    /**
     * @Vich\UploadableField(mapping="image_user", fileNameProperty="imageName")
     * @Assert\Image()
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(name="image_name", type="string", length=255)
     *
     * @var string
     */
    private $imageName;


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
     * Set imageName
     *
     * @param string $imageName
     *
     * @return ImageUser
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param File $imageFile
     * @return $this
     */
    public function setImageFile(File $imageFile)
    {
        $this->imageFile = $imageFile;

        if ($imageFile){
            $this->createdAt = new \DateTime('now');
        }

        return $this;
    }



    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ImageUser
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getWebPath() {
        return 'uploads/images/profiles/'.$this->getImageName();
    }
}
