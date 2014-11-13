<?php

namespace Journal\Model;

class Unit {

    protected $id;
    protected $grade_id;
    protected $fullname;

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->grade_id = (isset($data['grade_id'])) ? $data['grade_id'] : null;
        $this->fullname = (isset($data['fullname'])) ? $data['fullname'] : null;
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
