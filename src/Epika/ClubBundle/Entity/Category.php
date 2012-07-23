<?php

namespace Epika\ClubBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Epika\ClubBundle\Entity\Category
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Category
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @ORM\OneToMany(targetEntity="Bono", mappedBy="category")
     */
    private $bonos;
    
    /**
     * @ORM\OneToMany(targetEntity="Company", mappedBy="category")
     */
    private $companies;

    /**
     * @var datetime $created_at
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var datetime $updated_at
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updated_at;
    
    
    /********************************************* Class functions *********************************************/
    
    /**
     * Constructor
     */
    public function __construct() {
    	$this->bonos = new ArrayCollection();
    	$this->companies = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    }

    /**
     * Get updated_at
     *
     * @return datetime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Add bonos
     *
     * @param Epika\ClubBundle\Entity\Bono $bonos
     */
    public function addBono(\Epika\ClubBundle\Entity\Bono $bonos)
    {
        $this->bonos[] = $bonos;
    }

    /**
     * Get bonos
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getBonos()
    {
        return $this->bonos;
    }

    /**
     * Add companies
     *
     * @param Epika\ClubBundle\Entity\Company $companies
     */
    public function addCompany(\Epika\ClubBundle\Entity\Company $companies)
    {
        $this->companies[] = $companies;
    }

    /**
     * Get companies
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCompanies()
    {
        return $this->companies;
    }
}