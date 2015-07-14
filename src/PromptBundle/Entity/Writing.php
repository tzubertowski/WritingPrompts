<?php

namespace PromptBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Writing
 */
class Writing
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $dateCreated;

    /**
     * @var \DateTime
     */
    private $dateUpdated;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    /**
     * @OneToOne(targetEntity="UserBundle\User")
     * @JoinColumn(name="author_id", referencedColumnName="id")
     **/
    private $author;

    /**
     * @ManyToMany(targetEntity="PromptBundle\Vote")
     * @JoinTable(name="writings_votes",
     *      joinColumns={@JoinColumn(name="writing_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="vote_id", referencedColumnName="id", unique=true)}
     *      )
     **/
    private $votes;

    /**
     * @ManyToOne(targetEntity="PromptBundle\Prompt", inversedBy="writings")
     * @JoinColumn(name="prompt_id", referencedColumnName="id")
     **/
    private $prompt;

    /**
     * @var integer
     */
    private $rating;

    public function __construct() {
        $this->votes = new ArrayCollection();
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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Writing
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated
     * @return Writing
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return \DateTime 
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Writing
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Writing
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
     * Set content
     *
     * @param string $content
     * @return Writing
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * @param mixed $votes
     */
    public function setVotes($votes)
    {
        $this->votes = $votes;
    }

    /**
     * @param Vote $vote
     */
    public function addVotes(\PromptBundle\Entity\Vote $vote)
    {
        $this->votes[]      = $vote;
        // Zmienia wartosc ratingu w zaleznosci od glosu
        $this->setRating    = $this->rating + $vote->getValue();
    }

    /**
     * @return mixed
     */
    public function getPrompt()
    {
        return $this->prompt;
    }

    /**
     * @param mixed $prompt
     */
    public function setPrompt($prompt)
    {
        $this->prompt = $prompt;
    }
}
