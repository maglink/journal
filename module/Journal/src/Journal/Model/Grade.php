<?php
namespace Journal\Model;
 
class Grade
{
    public $id;
    public $level;
    public $prefix;
 
    public function exchangeArray($data)
    {
        $this->id       = (isset($data['id'])) ? $data['id'] : null;
        $this->level    = (isset($data['level'])) ? $data['level'] : null;
        $this->prefix   = (isset($data['prefix'])) ? $data['prefix'] : null;
    }
}

