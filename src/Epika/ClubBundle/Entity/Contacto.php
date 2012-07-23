<?php

namespace Epika\ClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Epika\ClubBundle\Entity\Contacto
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Contacto
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
     * @var string $last_name
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $last_name;

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
     * @var string $photo
     * 
     * @ORM\Column(name="photo", type="string", length=255)
     */
    private $photo;
    
    /**
     * @ORM\OneToOne(targetEntity="Company", mappedBy="contacto")
     */
    private $company;
    
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

    /********************************* Class functions ****************************************/

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
     * Set photo
     *
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set company
     *
     * @param Epika\ClubBundle\Entity\Company $company
     */
    public function setCompany(\Epika\ClubBundle\Entity\Company $company)
    {
        $this->company = $company;
    }

    /**
     * Get company
     *
     * @return Epika\ClubBundle\Entity\Company 
     */
    public function getCompany()
    {
        return $this->company;
    }
    
    /******************************* Path and Upload methods **************************************/
    public function getAbsolutePath()
    {
    	return null === $this->photo ? null : $this->getUploadRootDir().'/'.$this->photo;
    }
    
    public function getWebPath()
    {
    	return null === $this->photo ? null : $this->getUploadDir().'/'.$this->photo;
    }
    
    public function getUploadRootDir()
    {
    	// the absolute directory path where uploaded documents should be saved
    	return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
    
    protected function getUploadDir()
    {
    	// get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
    	return '/images/uploads/contacto';
    }
    
    /***************************** End of upload methods *****************************************/

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
}