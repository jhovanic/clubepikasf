<?php

namespace Epika\ClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Epika\ClubBundle\Entity\Bono_Images
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Bono_Images
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
     * @var string $path
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var string $thumb
     *
     * @ORM\Column(name="thumb", type="string", length=255)
     */
    private $thumb;
    
    /**
     * @var boolean $screenshot
     * @ORM\Column(name="screenshot", type="boolean", nullable=true)
     */
    private $screenshot;

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
     * @ORM\ManyToOne(targetEntity="Bono", inversedBy="images")
     * @ORM\JoinColumn(name="bono_id", referencedColumnName="id")
     */
    private $bono;

    /****************************************** Class functions **********************************/
    
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
     * Set path
     *
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set thumb
     *
     * @param string $thumb
     */
    public function setThumb($thumb)
    {
        $this->thumb = $thumb;
    }

    /**
     * Get thumb
     *
     * @return string 
     */
    public function getThumb()
    {
        return $this->thumb;
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
    
    /*********************************** Upload functions ********************************/
    
    public function getAbsolutePath()
    {
    	return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }
    
    public function getWebPath()
    {
    	return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
    }
    
    public function getUploadRootDir()
    {
    	// the absolute directory path where uploaded documents should be saved
    	return __DIR__.'/../../../../web'.$this->getUploadDir();
    }
    
    protected function getUploadDir()
    {
    	// get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
    	return '/images/uploads/bono';
    }
    
    /******************************* END UPLOAD FUNCTIONS *********************************/
    

    /**
     * Set screenshot
     *
     * @param boolean $screenshot
     */
    public function setScreenshot($screenshot)
    {
        $this->screenshot = $screenshot;
    }

    /**
     * Get screenshot
     *
     * @return boolean 
     */
    public function getScreenshot()
    {
        return $this->screenshot;
    }
    
    public function removeUploadedImage()
    {
    	if ($this->getAbsolutePath()) {
    		unlink($this->getAbsolutePath());
    	}
    }
}