<?php

namespace PromptBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PromptPoll
 */
class PromptPoll
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $rating;

    /**
     * @ManyToMany(targetEntity="PromptBundle\Vote")
     * @JoinTable(name="writings_votes",
     *      joinColumns={@JoinColumn(name="promptpoll_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="vote_id", referencedColumnName="id", unique=true)}
     *      )
     **/
    private $votes;

    /**
     * @ManyToOne(targetEntity="PromptBundle\WeeklyPromptPoll", inversedBy="$promptPolls")
     * @JoinColumn(name="weeklypromptpoll_id", referencedColumnName="id")
     **/
    private $weeklyPoll;

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
     * Set title
     *
     * @param string $title
     * @return PromptPoll
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
     * Set description
     *
     * @param string $description
     * @return PromptPoll
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
    public function getWeeklyPoll()
    {
        return $this->weeklyPoll;
    }

    /**
     * @param mixed $weeklyPoll
     */
    public function setWeeklyPoll($weeklyPoll)
    {
        $this->weeklyPoll = $weeklyPoll;
    }
}