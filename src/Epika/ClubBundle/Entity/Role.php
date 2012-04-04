<?php

namespace Epika\ClubBundle\Entity;

use Symfony\Component\Security\Core\Role\RoleInterface;

use Doctrine\ORM\Mapping as ORM;

/**
 * Epika\ClubBundle\Entity\Role
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Role implements RoleInterface
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

    /************************ Getters and Setters ************************************************/

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
     * Get Role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->name;
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
}