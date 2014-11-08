<?php
namespace Journal\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="grade")
 */
class Grade
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer");
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;
    
    /** @ORM\Column(type="integer") */
    protected $level;
    
    /** @ORM\Column(type="string") */
    protected $prefix;
    
    /** @ORM\OneToMany(targetEntity="Unit", mappedBy="grade") */
    protected $units;

    /** @ORM\OneToMany(targetEntity="Lesson", mappedBy="grade") */
    protected $lessons;
 
    /**
    * @ORM\ManyToMany(targetEntity="Subject")
    * @ORM\JoinTable(name="lesson",
    *      joinColumns={@ORM\JoinColumn(name="grade_id", referencedColumnName="id")},
    *      inverseJoinColumns={@ORM\JoinColumn(name="subject_id", referencedColumnName="id")}
    *      )
    **/
    protected $subjects;
    
    public function __construct() {
        $this->units = new ArrayCollection();
        $this->lessons = new ArrayCollection();
        $this->subjects = new ArrayCollection();
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