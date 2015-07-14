<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as FOSUser;

/**
 * User
 */
class User extends FOSUser
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @OneToMany(targetEntity="PromptBundle\Vote", mappedBy="user")
     **/
    private $votes;

    public function __construct() {
        parent::__construct();
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
     * @return mixed
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * @param mixed $votes
     */
    public function setVotes(\PromptBundle\Entity\Vote $vote)
    {
        $this->votes = $vote;
    }

    public function addVotes(\PromptBundle\Entity\Vote $vote) {
        $this->votes[] = $vote;
    }
}
