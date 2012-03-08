<?php

namespace Epika\ClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Epika\ClubBundle\Entity\Afiliate_Bono
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Afiliate_Bono
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
     * @var datetime $activation_date
     *
     * @ORM\Column(name="activation_date", type="datetime", nullable=true)
     */
    private $activation_date;

    /**
     * @var boolean $is_active
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $is_active;

    /**
     * @ORM\ManyToOne(targetEntity="Afiliate", inversedBy="bonos")
     * @ORM\JoinColumn(name="afiliate_id", referencedColumnName="id")
     */
    private $afiliate;
    
    /**
     * @ORM\ManyToOne(targetEntity="Bono")
     * @ORM\JoinColumn(name="bono_id", referencedColumnName="id")
     */
    private $bono;
    
    /******************************************** Class functions ******************************************/

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
     * Set activation_date
     *
     * @param datetime $activationDate
     */
    public function setActivationDate($activationDate)
    {
        $this->activation_date = $activationDate;
    }

    /**
     * Get activation_date
     *
     * @return datetime 
     */
    public function getActivationDate()
    {
        return $this->activation_date;
    }

    /**
     * Set is_active
     *
     * @param boolean $isActive
     */
    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;
    }

    /**
     * Get is_active
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Set afiliate
     *
     * @param Epika\ClubBundle\Entity\Afiliate $afiliate
     */
    public function setAfiliate(\Epika\ClubBundle\Entity\Afiliate $afiliate)
    {
        $this->afiliate = $afiliate;
    }

    /**
     * Get afiliate
     *
     * @return Epika\ClubBundle\Entity\Afiliate 
     */
    public function getAfiliate()
    {
        return $this->afiliate;
    }

    /**
     * Set bono
     *
     * @param Epika\ClubBundle\Entity\Bono $bono
     */
    public function setBono(\Epika\ClubBundle\Entity\Bono $bono)
    {
        $this->bono = $bono;
    }

    /**
     * Get bono
     *
     * @return Epika\ClubBundle\Entity\Bono 
     */
    public function getBono()
    {
        return $this->bono;
    }
}