<?php
namespace Journal\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="unit")
 */
class Unit
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer");
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;
    
    /** @ORM\Column(type="string") */
    protected $fullname;
    
    /**
     * @ORM\ManyToOne(targetEntity="Grade", inversedBy="units")
     * @ORM\JoinColumn(name="grade_id", referencedColumnName="id")
     **/
    protected $grade;
    
    /** @ORM\OneToMany(targetEntity="Mark", mappedBy="unit") */
    protected $marks;

    public function __construct() {
        $this->marks = new ArrayCollection();
    }
    
    public function __get($property) 
    {
        return $this->$property;
    }
    
    public function __set($property, $value) 
    {
        $this->$property = $value;
    }

}