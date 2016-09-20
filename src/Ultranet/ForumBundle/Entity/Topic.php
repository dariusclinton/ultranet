<?php

namespace Ultranet\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToOne(targetEntity="Ultranet\UserBundle\Entity\User")
     */
    private $createur;
    
    /**
     * @ORM\OneToOne(targetEntity="Post")
     */
    private $lastPost;
    
    /**
     * @ORM\OneToOne(targetEntity="Post")
     */
    private $firstPost;
    
    /**
     * @ORM\ManyToOne(targetEntity="Forum")
     */
    private $forum;

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
     * Set createur
     *
     * @param \Ultranet\ForumBundle\Entity\User $createur
     *
     * @return Topic
     */
    public function setCreateur(\Ultranet\ForumBundle\Entity\User $createur = null)
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
}
