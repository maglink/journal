<?php

namespace Journal\Form;
 
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator;
 
class MarkForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('mark');
        
        $unit_id = new Element('unit_id');
        /*$unit_id->setAttributes(array(
            'type'  => 'hidden'
        ));*/
        
        $lesson_id = new Element('lesson_id');
        $lesson_id->setAttributes(array(
            'type'  => 'hidden'
        ));
        
        $value = new Element('value');
        $value->setLabel('Value');
        $value->setAttributes(array(
            'type'  => 'text'
        ));
        
        $submit= new Element('submit');
        $submit->setAttributes(array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
        ));  
        
        $this->setAttribute('method', 'post');
        $this->add($unit_id);
        $this->add($unit_id);
        $this->add($lesson_id);
        $this->add($value);
        $this->add($submit);

        $this->setInputFilter($this->getInputFilter());

    }
    
    public function getInputFilter()
    {
 
        $unit_id = new Input('unit_id');
        $unit_id->setRequired(true)
                ->setAllowEmpty(false); 
        $unit_id->getFilterChain()
                ->attachByName('Int');

        $lesson_id = new Input('unit_id');
        $lesson_id->setRequired(true)
                ->setAllowEmpty(false); 
        $lesson_id->getFilterChain()
                ->attachByName('Int');

        $value = new Input('value');
        $value->getFilterChain()
                ->attachByName('Int');
        
        $inputFilter = new InputFilter();
        $inputFilter->add($unit_id);
        $inputFilter->add($lesson_id);
        $inputFilter->add($value);
        $inputFilter->setData($_POST);

        return $inputFilter;
    }
}

