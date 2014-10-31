<?php
namespace Journal\Model;
 
class Subject
{
    public $id;
    public $grade_id;
    public $name;
 
    public function exchangeArray($data)
    {
        $this->id       = (isset($data['id'])) ? $data['id'] : null;
        $this->grade_id = (isset($data['grade_id'])) ? $data['grade_id'] : null;
        $this->name     = (isset($data['name'])) ? $data['name'] : null;
    }
}

