<?php

namespace Ultranet\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Topic
 *
 * @ORM\Table(name="ultranet_topic")
 * @ORM\Entity(repositoryClass="Ultranet\ForumBundle\Repository\TopicRepository")
 */
class Topic
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
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="topic_time", type="datetime")
     */
    private $topicTime;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_resolu", type="boolean")
     */
    private $isResolu = false ;
    
    /**
     * @ORM\ManyToOne(targetEntity="Ultranet\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createur;
    
    /**
     * @ORM\OneToOne(targetEntity="Post", cascade={"persist", "remove"})
     */
    private $lastPost;
    
    /**
     * @ORM\OneToOne(targetEntity="Post", cascade={"persist", "remove"})
     */
    private $firstPost;
    
    /**
     * @ORM\ManyToOne(targetEntity="Forum", inversedBy="topics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $forum;
    
    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="topic")
     */
    private $posts;
    
    /**
     * Constructeur
     */
    function __construct() {
      $this->topicTime = new \DateTime();
      $this->posts = new ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return Topic
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set topicTime
     *
     * @param \DateTime $topicTime
     *
     * @return Topic
     */
    public function setTopicTime($topicTime)
    {
        $this->topicTime = $topicTime;

        return $this;
    }

    /**
     * Get topicTime
     *
     * @return \DateTime
     */
    public function getTopicTime()
    {
        return $this->topicTime;
    }

    /**
     * Set isResolu
     *
     * @param boolean $isResolu
     *
     * @return Topic
     */
    public function setIsResolu($isResolu)
    {
        $this->isResolu = $isResolu;

        return $this;
    }

    /**
     * Get isResolu
     *
     * @return boolean
     */
    public function getIsResolu()
    {
        return $this->isResolu;
    }

    /**
     * Set createur
     *
     * @param \Ultranet\UserBundle\Entity\User $createur
     *
     * @return Topic
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
     * Set lastPost
     *
     * @param \Ultranet\ForumBundle\Entity\Post $lastPost
     *
     * @return Topic
     */
    public function setLastPost(\Ultranet\ForumBundle\Entity\Post $lastPost = null)
    {
        $this->lastPost = $lastPost;

        return $this;
    }

    /**
     * Get lastPost
     *
     * @return \Ultranet\ForumBundle\Entity\Post
     */
    public function getLastPost()
    {
        return $this->lastPost;
    }

    /**
     * Set firstPost
     *
     * @param \Ultranet\ForumBundle\Entity\Post $firstPost
     *
     * @return Topic
     */
    public function setFirstPost(\Ultranet\ForumBundle\Entity\Post $firstPost = null)
    {
        $this->firstPost = $firstPost;

        return $this;
    }

    /**
     * Get firstPost
     *
     * @return \Ultranet\ForumBundle\Entity\Post
     */
    public function getFirstPost()
    {
        return $this->firstPost;
    }

    /**
     * Set forum
     *
     * @param \Ultranet\ForumBundle\Entity\Forum $forum
     *
     * @return Topic
     */
    public function setForum(\Ultranet\ForumBundle\Entity\Forum $forum = null)
    {
        $this->forum = $forum;

        return $this;
    }

    /**
     * Get forum
     *
     * @return \Ultranet\ForumBundle\Entity\Forum
     */
    public function getForum()
    {
        return $this->forum;
    }

    /**
     * Add post
     *
     * @param \Ultranet\ForumBundle\Entity\Post $post
     *
     * @return Topic
     */
    public function addPost(\Ultranet\ForumBundle\Entity\Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \Ultranet\ForumBundle\Entity\Post $post
     */
    public function removePost(\Ultranet\ForumBundle\Entity\Post $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
