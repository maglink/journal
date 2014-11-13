<?php
namespace Journal\Model;

class Grade
{
    protected $id;
    protected $level;
    protected $prefix;
    
    protected $units = [];
    protected $lessons = [];
    protected $marks = [];

    public function exchangeArray($data)
    {

        $this->id       = (isset($data['id'])) ? $data['id'] : null;
        $this->level    = (isset($data['level'])) ? $data['level'] : null;
        $this->prefix   = (isset($data['prefix'])) ? $data['prefix'] : null;
        
        $unit = new Unit();
        $unit->id = $data['unit_id'];
        $unit->grade_id = $data['id'];
        $unit->fullname = $data['unit_fullname'];

        $this->units[] = $unit;
        
        $lesson = new Lesson();
        $lesson->id = $data['lesson_id'];
        $lesson->grade_id = $data['id'];
        $lesson->subject_id = $data['subject_id'];
        $lesson->date = $data['lesson_date'];

        $this->lessons[] = $lesson;
        
        $mark = new Mark();
        $mark->unit_id = $data['unit_id'];
        $mark->lesson_id = $data['lesson_id'];
        $mark->value = $data['mark_value'];

        $this->marks[] = $mark;
               
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

