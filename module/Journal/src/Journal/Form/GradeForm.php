<?php

namespace Journal\Form;
 
use Zend\Form\Form;
 
class GradeForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('grade');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'level',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Level',
            ),
        ));
        $this->add(array(
            'name' => 'prefix',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Prefix',
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

