<?php

namespace Ultranet\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Forum
 *
 * @ORM\Table(name="ultranet_forum")
 * @ORM\Entity(repositoryClass="Ultranet\ForumBundle\Repository\ForumRepository")
 */
class Forum {

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
   * @ORM\Column(name="name", type="string", length=255, unique=true)
   */
  private $name;

  /**
   * @var string
   *
   * @ORM\Column(name="description", type="text", nullable=true)
   */
  private $description;

  /**
   * @var int
   *
   * @ORM\Column(name="ordre", type="integer")
   */
  private $ordre;

  /**
   * @ORM\ManyToOne(targetEntity="Category")
   */
  private $category;

  /**
   * @ORM\OneToOne(targetEntity="Post")
   */
  private $lastPost;

  /**
   * @ORM\OneToMany(targetEntity="Topic", mappedBy="forum")
   */
  private $topics;

  /**
   * Constructor
   */
  public function __construct() {
    $this->topics = new \Doctrine\Common\Collections\ArrayCollection();
  }

  /**
   * Get id
   *
   * @return int
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set name
   *
   * @param string $name
   *
   * @return Forum
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
   * Set description
   *
   * @param string $description
   *
   * @return Forum
   */
  public function setDescription($description) {
    $this->description = $description;

    return $this;
  }

  /**
   * Get description
   *
   * @return string
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * Set ordre
   *
   * @param integer $ordre
   *
   * @return Forum
   */
  public function setOrdre($ordre) {
    $this->ordre = $ordre;

    return $this;
  }

  /**
   * Get ordre
   *
   * @return int
   */
  public function getOrdre() {
    return $this->ordre;
  }

  /**
   * Set category
   *
   * @param \Ultranet\ForumBundle\Entity\Category $category
   *
   * @return Forum
   */
  public function setCategory(\Ultranet\ForumBundle\Entity\Category $category = null) {
    $this->category = $category;

    return $this;
  }

  /**
   * Get category
   *
   * @return \Ultranet\ForumBundle\Entity\Category
   */
  public function getCategory() {
    return $this->category;
  }

  /**
   * Set lastPost
   *
   * @param \Ultranet\ForumBundle\Entity\Post $lastPost
   *
   * @return Forum
   */
  public function setLastPost(\Ultranet\ForumBundle\Entity\Post $lastPost = null) {
    $this->lastPost = $lastPost;

    return $this;
  }

  /**
   * Get lastPost
   *
   * @return \Ultranet\ForumBundle\Entity\Post
   */
  public function getLastPost() {
    return $this->lastPost;
  }

  /**
   * Add topic
   *
   * @param \Ultranet\ForumBundle\Entity\Topic $topic
   *
   * @return Forum
   */
  public function addTopic(\Ultranet\ForumBundle\Entity\Topic $topic) {
    $this->topics[] = $topic;

    return $this;
  }

  /**
   * Remove topic
   *
   * @param \Ultranet\ForumBundle\Entity\Topic $topic
   */
  public function removeTopic(\Ultranet\ForumBundle\Entity\Topic $topic) {
    $this->topics->removeElement($topic);
  }

  /**
   * Get topics
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getTopics() {
    return $this->topics;
  }
  
  /**
   * Methode permettant d'evaluer la nombre de posts sur le forum
   * @return type
   */
  public function getNombrePosts() {
    $nb = 0;
    
    foreach ($this->topics as $topic) {
      $nb += count($topic->getPosts()->toArray());
    }
    
    return $nb;
  }

}
