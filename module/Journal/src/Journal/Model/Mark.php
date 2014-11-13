<?php
namespace Journal\Model;

class Mark
{
    protected $unit_id;
    protected $lesson_id;
    protected $value;
 
    public function exchangeArray($data)
    {
        $this->unit_id  = (isset($data['unit_id'])) ? $data['unit_id'] : null;
        $this->lesson_id = (isset($data['lesson_id'])) ? $data['lesson_id'] : null;
        $this->value = (isset($data['value'])) ? $data['value'] : null;
    }
    
    public function getArrayCopy()
    {
        return get_object_vars($this);
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

