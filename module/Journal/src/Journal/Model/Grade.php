<?php
namespace Journal\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Grade implements InputFilterAwareInterface
{
    public $id;
    public $level;
    public $prefix;
    protected $inputFilter;
 
    public function exchangeArray($data)
    {
        $this->id       = (isset($data['id'])) ? $data['id'] : null;
        $this->level    = (isset($data['level'])) ? $data['level'] : null;
        $this->prefix   = (isset($data['prefix'])) ? $data['prefix'] : null;
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
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));
 
            $inputFilter->add($factory->createInput(array(
                'name'     => 'level',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                ),
            )));
 
            $inputFilter->add($factory->createInput(array(
                'name'     => 'prefix',
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 0,
                            'max'      => 50,
                        ),
                    ),
                ),
            )));
 
            $this->inputFilter = $inputFilter;
        }
 
        return $this->inputFilter;
    }
}

