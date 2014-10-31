<?php
namespace Journal\Model;
 
class Mark
{
    public $unit_id;
    public $lesson_id;
    public $value;
 
    public function exchangeArray($data)
    {
        $this->unit_id  = (isset($data['unit_id'])) ? $data['unit_id'] : null;
        $this->lesson_id = (isset($data['lesson_id'])) ? $data['lesson_id'] : null;
        $this->value = (isset($data['value'])) ? $data['value'] : null;
    }
}

