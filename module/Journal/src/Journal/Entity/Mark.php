<?php
namespace Journal\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="mark")
 */
class Mark
{
    /**
    * @ORM\Id
    * @ORM\ManyToOne(targetEntity="Unit", inversedBy="unit")
    * @ORM\JoinColumn(name="unit_id", referencedColumnName="id")
    **/
    protected $unit;
    
    /**
    * @ORM\Id
    * @ORM\ManyToOne(targetEntity="Lesson", inversedBy="lesson")
    * @ORM\JoinColumn(name="lesson_id", referencedColumnName="id")
    **/
    protected $lesson;
    
    /** @ORM\Column(type="integer") */
    protected $value;
    
    public function __get($property) 
    {
        return $this->$property;
    }
    
    public function __set($property, $value) 
    {
        $this->$property = $value;
    }

}