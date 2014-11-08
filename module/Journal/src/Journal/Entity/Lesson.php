<?php
namespace Journal\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="lesson")
 */
class Lesson
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer");
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;
    
    /** @ORM\Column(type="date") */
    protected $date;   
    
    /**
     * @ORM\ManyToOne(targetEntity="Grade", inversedBy="lessons")
     * @ORM\JoinColumn(name="grade_id", referencedColumnName="id")
     **/
    protected $grade;

    /**
     * @ORM\ManyToOne(targetEntity="Subject", inversedBy="lessons")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id")
     **/
    protected $subject;

    /** @ORM\OneToMany(targetEntity="Mark", mappedBy="lesson") */
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