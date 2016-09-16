<?php

namespace Ultranet\UserBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Image
 *
 * @ORM\Table(name="ultranet_image")
 * @ORM\Entity(repositoryClass="Ultranet\UserBundle\Repository\ImageRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Image
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
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;

    /**
   * @Assert\Image(maxSize="2M", maxSizeMessage="La taille du fichier doit être < 2Mo")
   */
  private $file;
  
  private $tmpFilename;
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }
    
    function getFile() {
      return $this->file;
    }

    function setFile(UploadedFile $file) {
      $this->file = $file;
      
      if (null !== $this->url) {
        $this->tmpFilename = $this->url;
        
        $this->url = null;
        $this->alt = null;
      }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
      if (null === $this->file) {
        return;
      }
      
      $this->url = $this->file->guessExtension();
      $this->alt = $this->file->getClientOriginalName();
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
      if (null === $this->file) {
        return;
      }
      
      if (null !== $this->tmpFilename) {
        $oldFile = $this->getUploadRootDir().'/'.$this->getId().'.'.$this->tmpFilename;
        if (file_exists($oldFile)) {
          unlink($oldFile);
        }
      }
      
      $this->file->move($this->getUploadRootDir(), $this->getId().'.'.$this->url);
    }
    
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
      if (file_exists($this->tmpFilename)) {
        unlink($this->tmpFilename);
      }
    }
    
    public function getUploadDir() {
     return 'uploads/images/profiles';
    }
    
    public function getUploadRootDir() {
      return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
    
    public function getWebPath() {
      return $this->getUploadDir() . '/' . $this->getId() . '.' . $this->getUrl();
    }

}
