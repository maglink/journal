<?php
namespace Journal\Model;
 
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;


class GradeTable
{
    protected $tableGateway;
 
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
 
    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
 
    public function getGrade($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }
    
    public function getGradeJournalBySybjectInDateRange($grade, $subject, $date_from, $date_to)    {

        $select = new \Zend\Db\Sql\Select();
        $select->from(array('g' => 'grade'));
        $select->join(array('u' => 'unit'), 
                'u.grade_id = g.id', 
                array('unit_id' => 'id', 'unit_fullname' => 'fullname'), 
                $select::JOIN_INNER);
        $select->join(array('L' => 'lesson'), 
                'L.grade_id = g.id', 
                array('lesson_id' => 'id', 'lesson_date' => 'date', 'subject_id'), 
                $select::JOIN_INNER);
        $select->join(array('m' => 'mark'), 
                'm.unit_id = u.id AND m.lesson_id = L.id', 
                array('mark_value' => 'value'), 
                $select::JOIN_LEFT);
        $select->where(array('g.id' => $grade->id));
        $select->where(array('L.subject_id' => $subject->id));
        $select->where->between('date', 
                $date_from->format("Y-m-d"), $date_to->format("Y-m-d"));
        $select->order(array('u.fullname DESC', 'L.date DESC'));

        $rowset = $this->tableGateway->selectWith($select);
        $records = array();
        foreach ($rowset as $row)
        {
            $records[] = array(
                'unit_id' => $row->units[0]->id,
                'unit_fullname' => $row->units[0]->fullname,
                'lesson_id' => $row->lessons[0]->id,
                'lesson_date' => $row->lessons[0]->date,
                'mark_value' => $row->marks[0]->value,
            );
        }

        return $records;
    }
}