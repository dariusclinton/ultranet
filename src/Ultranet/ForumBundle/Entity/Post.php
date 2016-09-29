<?php

namespace Ultranet\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="ultranet_post")
 * @ORM\Entity(repositoryClass="Ultranet\ForumBundle\Repository\PostRepository")
 */
class Post
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
     * @ORM\Column(name="texte", type="text")
     */
    private $texte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="post_time", type="datetime")
     */
    private $postTime;

    /**
     * @ORM\ManyToOne(targetEntity="Ultranet\UserBundle\Entity\User")
     */
    private $createur;
    
    /**
     * @ORM\ManyToOne(targetEntity="Topic", inversedBy="posts")
     */
    private $topic;
    
    /**
     * Constructeur
     */
    public function __construct() {
      $this->postTime = new \DateTime();
    }

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
     * Set texte
     *
     * @param string $texte
     *
     * @return Post
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set postTime
     *
     * @param \DateTime $postTime
     *
     * @return Post
     */
    public function setPostTime($postTime)
    {
        $this->postTime = $postTime;

        return $this;
    }

    /**
     * Get postTime
     *
     * @return \DateTime
     */
    public function getPostTime()
    {
        return $this->postTime;
    }

    /**
     * Set createur
     *
     * @param \Ultranet\UserBundle\Entity\User $createur
     *
     * @return Post
     */
    public function setCreateur(\Ultranet\UserBundle\Entity\User $createur = null)
    {
        $this->createur = $createur;

        return $this;
    }

    /**
     * Get createur
     *
     * @return \Ultranet\ForumBundle\Entity\User
     */
    public function getCreateur()
    {
        return $this->createur;
    }

    /**
     * Set topic
     *
     * @param \Ultranet\ForumBundle\Entity\Topic $topic
     *
     * @return Post
     */
    public function setTopic(\Ultranet\ForumBundle\Entity\Topic $topic = null)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic
     *
     * @return \Ultranet\ForumBundle\Entity\Topic
     */
    public function getTopic()
    {
        return $this->topic;
    }
}
