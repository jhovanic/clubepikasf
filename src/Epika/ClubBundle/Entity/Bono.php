<?php

namespace Epika\ClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Epika\ClubBundle\Entity\Bono
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Bono
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
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var text $long_description
     *
     * @ORM\Column(name="long_description", type="text")
     */
    private $long_description;

    /**
     * @var text $information
     *
     * @ORM\Column(name="information", type="text")
     */
    private $information;

    /**
     * @var text $conditions
     *
     * @ORM\Column(name="conditions", type="text")
     */
    private $conditions;

    /**
     * @var string $image
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var integer $price
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @var integer $discount
     *
     * @ORM\Column(name="discount", type="integer")
     */
    private $discount;

    /**
     * @var integer $save
     *
     * @ORM\Column(name="save", type="integer")
     */
    private $save;

    /**
     * @var smallint $type
     *
     * @ORM\Column(name="type", type="smallint")
     */
    private $type;

    /**
     * @var date $unpublish_date
     *
     * @ORM\Column(name="unpublish_date", type="date")
     */
    private $unpublish_date;

    /**
     * @var boolean $is_active
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $is_active;

    /**
     * @var integer $category
     *
     * @ORM\Column(name="category", type="integer")
     */
    private $category;

    /**
     * @var integer $company
     *
     * @ORM\Column(name="company", type="integer")
     */
    private $company;

    /**
     * @var integer $membership
     *
     * @ORM\Column(name="membership", type="integer")
     */
    private $membership;

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
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * Set long_description
     *
     * @param text $longDescription
     */
    public function setLongDescription($longDescription)
    {
        $this->long_description = $longDescription;
    }

    /**
     * Get long_description
     *
     * @return text 
     */
    public function getLongDescription()
    {
        return $this->long_description;
    }

    /**
     * Set information
     *
     * @param text $information
     */
    public function setInformation($information)
    {
        $this->information = $information;
    }

    /**
     * Get information
     *
     * @return text 
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * Set conditions
     *
     * @param text $conditions
     */
    public function setConditions($conditions)
    {
        $this->conditions = $conditions;
    }

    /**
     * Get conditions
     *
     * @return text 
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * Set image
     *
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set price
     *
     * @param integer $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set discount
     *
     * @param integer $discount
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }

    /**
     * Get discount
     *
     * @return integer 
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set save
     *
     * @param integer $save
     */
    public function setSave($save)
    {
        $this->save = $save;
    }

    /**
     * Get save
     *
     * @return integer 
     */
    public function getSave()
    {
        return $this->save;
    }

    /**
     * Set type
     *
     * @param smallint $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return smallint 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set unpublish_date
     *
     * @param date $unpublishDate
     */
    public function setUnpublishDate($unpublishDate)
    {
        $this->unpublish_date = $unpublishDate;
    }

    /**
     * Get unpublish_date
     *
     * @return date 
     */
    public function getUnpublishDate()
    {
        return $this->unpublish_date;
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
     * Set category
     *
     * @param integer $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * Get category
     *
     * @return integer 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set company
     *
     * @param integer $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * Get company
     *
     * @return integer 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set membership
     *
     * @param integer $membership
     */
    public function setMembership($membership)
    {
        $this->membership = $membership;
    }

    /**
     * Get membership
     *
     * @return integer 
     */
    public function getMembership()
    {
        return $this->membership;
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
}