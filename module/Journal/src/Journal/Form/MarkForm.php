<?php

namespace Journal\Form;
 
use Zend\Form\Element;
use Zend\Form\Form;

class MarkForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('mark');
        
        $unit_id = new Element('unit_id');
        $unit_id->setAttributes(array(
            'type'  => 'hidden'
        ));
        
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
    }

}

