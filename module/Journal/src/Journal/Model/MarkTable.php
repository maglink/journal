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
        if(!$row):
            return "-";
        endif;
        return $row->value;
    }
    
    public function saveMark(Mark $mark)
    {
        $data = array(
            'unit_id' => (int)$mark->unit_id,
            'lesson_id'  => (int)$mark->lesson_id,
            'value' => $mark->value,
        );
        $value = $this->getMarkValueByUnitAndLesson($mark->unit_id, $mark->lesson_id);
        if ($value != "-") {
            $this->tableGateway->update($data, array(
                'unit_id' => (int)$mark->unit_id,
                'lesson_id'  => (int)$mark->lesson_id
            ));
        } else {
            $this->tableGateway->insert($data);
        }
    }

}