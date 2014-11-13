<?php

namespace Journal\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator;
 
class MarkFilter extends InputFilter
{
    public function __construct()
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
        
        $this->add($unit_id);
        $this->add($lesson_id);
        $this->add($value);
        $this->setData($_POST);

    }    
}

