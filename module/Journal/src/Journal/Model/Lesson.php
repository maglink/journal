<?php
namespace Journal\Model;
 
class Lesson
{
    protected $id;
    protected $grade_id;
    protected $subject_id;
    protected $date;
 
    public function exchangeArray($data)
    {
        $this->id  = (isset($data['id'])) ? $data['id'] : null;
        $this->grade_id = (isset($data['grade_id'])) ? $data['grade_id'] : null;
        $this->subject_id = (isset($data['subject_id'])) ? $data['subject_id'] : null;
        $this->date = (isset($data['date'])) ? $data['date'] : null;
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

