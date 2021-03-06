<?php

namespace PromptBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * WeeklyPromptPoll
 */
class WeeklyPromptPoll
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
    private $dateStart;

    /**
     * @var \DateTime
     */
    private $dateEnd;

    /**
     * @ORM\OneToMany(targetEntity="PromptBundle\PromptPoll", mappedBy="weeklyPoll")
     **/
    private $promptPolls;

    public function __construct() {
        $this->promptPolls = new ArrayCollection();
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
     * @return WeeklyPromptPoll
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
     * Set dateStart
     *
     * @param \DateTime $dateStart
     * @return WeeklyPromptPoll
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime 
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     * @return WeeklyPromptPoll
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime 
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @return mixed
     */
    public function getPromptPolls()
    {
        return $this->promptPolls;
    }

    /**
     * @param mixed $promptPolls
     */
    public function setPromptPolls($promptPolls)
    {
        $this->promptPolls = $promptPolls;
    }

    public function addPromptPoll(\PromptBundle\Entity\PromptPoll $promptPoll) {
        $this->promptPolls[] = $promptPoll;
    }
}
