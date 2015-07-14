<?php

namespace PromptBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PromptBundle\PromptBundle;
use UserBundle\UserBundle;

/**
 * Vote
 */
class Vote
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $value;

    /**
     * @ManyToOne(targetEntity="UserBundle\User", inversedBy="votes")
     * @JoinColumn(name="product_id", referencedColumnName="id")
     **/
    private $user;

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
     * Set value
     *
     * @param integer $value
     * @return Vote
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser(\UserBundle\Entity\User $user)
    {
        $this->user = $user;
    }

}
