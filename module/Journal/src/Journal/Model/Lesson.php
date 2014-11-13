<?php
namespace Journal\Model;
 
class Lesson
{
    public $id;
    public $grade_id;
    public $subject_id;
    public $date;
 
    public function exchangeArray($data)
    {
        $this->id  = (isset($data['id'])) ? $data['id'] : null;
        $this->grade_id = (isset($data['grade_id'])) ? $data['grade_id'] : null;
        $this->subject_id = (isset($data['subject_id'])) ? $data['subject_id'] : null;
        $this->date = (isset($data['date'])) ? $data['date'] : null;
    }

}

