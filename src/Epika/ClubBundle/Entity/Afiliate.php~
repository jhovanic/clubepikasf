<?php

namespace Epika\ClubBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Epika\ClubBundle\Entity\Afiliate
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Afiliate
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
     * @var string $identification
     *
     * @ORM\Column(name="identification", type="string", length=255)
     */
    private $identification;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $last_name
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $last_name;

    /**
     * @var string $address
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string $neighborhood
     *
     * @ORM\Column(name="neighborhood", type="string", length=255)
     */
    private $neighborhood;

    /**
     * @var string $phone
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var string $cellphone
     *
     * @ORM\Column(name="cellphone", type="string", length=255)
     */
    private $cellphone;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string $gender
     *
     * @ORM\Column(name="gender", type="string", length=255)
     */
    private $gender;

    /**
     * @var date $birth_date
     *
     * @ORM\Column(name="birth_date", type="date")
     */
    private $birth_date;

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

    /**
     * @ORM\OneToMany(targetEntity="Afiliate_Bono", mappedBy="afiliate")
     */
    private $bonos;
    
    /**
     * @ORM\OneToOne(targetEntity="City")
     */
    private $city;
    
    /**
     * @ORM\OneToOne(targetEntity="Ocupation")
     */
    private $ocupation;
    
    /**
     * @ORM\OneToOne(targetEntity="User")
     */
    private $user;
    
    /****************************************** Class functions ***************************************/

    /**
     * Constructor
     */
    public function __construct() {
    	$this->bonos = new ArrayCollection();
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
     * Set identification
     *
     * @param string $identification
     */
    public function setIdentification($identification)
    {
        $this->identification = $identification;
    }

    /**
     * Get identification
     *
     * @return string 
     */
    public function getIdentification()
    {
        return $this->identification;
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
     * Set last_name
     *
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;
    }

    /**
     * Get last_name
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set address
     *
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set neighborhood
     *
     * @param string $neighborhood
     */
    public function setNeighborhood($neighborhood)
    {
        $this->neighborhood = $neighborhood;
    }

    /**
     * Get neighborhood
     *
     * @return string 
     */
    public function getNeighborhood()
    {
        return $this->neighborhood;
    }

    /**
     * Set phone
     *
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set cellphone
     *
     * @param string $cellphone
     */
    public function setCellphone($cellphone)
    {
        $this->cellphone = $cellphone;
    }

    /**
     * Get cellphone
     *
     * @return string 
     */
    public function getCellphone()
    {
        return $this->cellphone;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set gender
     *
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set birth_date
     *
     * @param date $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birth_date = $birthDate;
    }

    /**
     * Get birth_date
     *
     * @return date 
     */
    public function getBirthDate()
    {
        return $this->birth_date;
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
     * @param Epika\ClubBundle\Entity\Afiliate_Bono $bonos
     */
    public function addAfiliate_Bono(\Epika\ClubBundle\Entity\Afiliate_Bono $bonos)
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
     * Set city
     *
     * @param Epika\ClubBundle\Entity\City $city
     */
    public function setCity(\Epika\ClubBundle\Entity\City $city)
    {
        $this->city = $city;
    }

    /**
     * Get city
     *
     * @return Epika\ClubBundle\Entity\City 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set ocupation
     *
     * @param Epika\ClubBundle\Entity\Ocupation $ocupation
     */
    public function setOcupation(\Epika\ClubBundle\Entity\Ocupation $ocupation)
    {
        $this->ocupation = $ocupation;
    }

    /**
     * Get ocupation
     *
     * @return Epika\ClubBundle\Entity\Ocupation 
     */
    public function getOcupation()
    {
        return $this->ocupation;
    }

    /**
     * Set user
     *
     * @param Epika\ClubBundle\Entity\User $user
     */
    public function setUser(\Epika\ClubBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return Epika\ClubBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}