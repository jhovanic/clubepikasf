<?php

namespace Epika\ClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Epika\ClubBundle\Entity\Card
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Card
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $number
     *
     * @ORM\Column(name="number", type="string", length=255, unique=true)
     */
    private $number;

    /**
     * @var date $expiration_date
     *
     * @ORM\Column(name="expiration_date", type="date")
     */
    private $expiration_date;
    
    /**
     * @ORM\ManyToOne(targetEntity="Membership")
     */
    private $membership;

    /********************************* Getters and Setters *********************************************/

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
     * Set number
     *
     * @param string $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set expiration_date
     *
     * @param date $expirationDate
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expiration_date = $expirationDate;
    }

    /**
     * Get expiration_date
     *
     * @return date 
     */
    public function getExpirationDate()
    {
        return $this->expiration_date;
    }

    /**
     * Set membership
     *
     * @param Epika\ClubBundle\Entity\Membership $membership
     */
    public function setMembership(\Epika\ClubBundle\Entity\Membership $membership)
    {
        $this->membership = $membership;
    }

    /**
     * Get membership
     *
     * @return Epika\ClubBundle\Entity\Membership 
     */
    public function getMembership()
    {
        return $this->membership;
    }
}