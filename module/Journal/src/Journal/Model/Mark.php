<?php
namespace Journal\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Mark implements InputFilterAwareInterface
{
    public $unit_id;
    public $lesson_id;
    public $value;
    protected $inputFilter;
 
    public function exchangeArray($data)
    {
        $this->unit_id  = (isset($data['unit_id'])) ? $data['unit_id'] : null;
        $this->lesson_id = (isset($data['lesson_id'])) ? $data['lesson_id'] : null;
        $this->value = (isset($data['value'])) ? $data['value'] : null;
    }
    
    public function getArrayCopy()
    {
        return get_object_vars($this);
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

