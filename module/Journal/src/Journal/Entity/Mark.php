<?php
namespace Journal\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="mark")
 */
class Mark implements InputFilterAwareInterface
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

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new Exception("Not used");
    }
 
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();
 
            $inputFilter->add($factory->createInput(array(
                'name'     => 'unit_id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'lesson_id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));
             
            $inputFilter->add($factory->createInput(array(
                'name'     => 'value',
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));
 
            $this->inputFilter = $inputFilter;
        }
 
        return $this->inputFilter;
    }
}