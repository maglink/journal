<?php

namespace Journal\Form;
 
use Zend\Form\Form;
 
class MarkForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('mark');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'unit_id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'lesson_id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'value',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Value',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}

