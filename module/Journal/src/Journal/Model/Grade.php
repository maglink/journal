<?php
namespace Journal\Model;

class Grade
{
    public $id;
    public $level;
    public $prefix;
    
    public $units = [];
    public $lessons = [];
    public $marks = [];

    public function exchangeArray($data)
    {

        $this->id       = (isset($data['id'])) ? $data['id'] : null;
        $this->level    = (isset($data['level'])) ? $data['level'] : null;
        $this->prefix   = (isset($data['prefix'])) ? $data['prefix'] : null;
        
        if(isset($data['unit_id'])):
            $unit = new Unit();
            $unit->id = $data['unit_id'];
            $unit->grade_id = $data['id'];
            $unit->fullname = $data['unit_fullname'];
            $this->units[] = $unit;            
        endif;

        if(isset($data['lesson_id'])):  
            $lesson = new Lesson();
            $lesson->id = $data['lesson_id'];
            $lesson->grade_id = $data['id'];
            $lesson->subject_id = $data['subject_id'];
            $lesson->date = $data['lesson_date'];
            $this->lessons[] = $lesson;            
        endif;  

        if(isset($data['unit_id']) 
                && isset($data['lesson_id'])
                && isset($data['mark_value'])): 
            $mark = new Mark();
            $mark->unit_id = $data['unit_id'];
            $mark->lesson_id = $data['lesson_id'];
            $mark->value = $data['mark_value'];
            $this->marks[] = $mark;            
        endif;
               
    }
}

