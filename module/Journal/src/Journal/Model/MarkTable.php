<?php
namespace Journal\Model;
 
use Zend\Db\TableGateway\TableGateway;
 
class MarkTable
{
    protected $tableGateway;
 
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function getMarkValueByUnitAndLesson($unit_id, $lesson_id)
    {
        $unit_id  = (int) $unit_id;
        $lesson_id  = (int) $lesson_id;
        $rowset = $this->tableGateway->select(
            array(
                'unit_id' => $unit_id, 
                'lesson_id' => $lesson_id
            )
        );
        $row = $rowset->current();
        if(!$row) {
            return NULL;
        }
        return $row->value;
    }
}