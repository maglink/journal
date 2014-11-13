<?php

namespace Journal\Model;

class Unit {

    public $id;
    public $grade_id;
    public $fullname;

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->grade_id = (isset($data['grade_id'])) ? $data['grade_id'] : null;
        $this->fullname = (isset($data['fullname'])) ? $data['fullname'] : null;
    }

}
