<?php
namespace Journal\Model;
 
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
 
class LessonTable
{
    protected $tableGateway;
 
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function getLesson($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }
    
    public function getSubjectsByGrade($grade_id)
    {
        $grade_id  = (int) $grade_id;

        $select = $this->tableGateway->getSql()->select();
        $select->columns(array('subject_id'));
        $where = $select->where;
        $where->equalTo('grade_id', $grade_id);
        $result_set = $this->tableGateway->selectWith($select);

        $distincted_result = array();
        foreach ($result_set as $rowset) {
            if (!in_array($rowset, $distincted_result)) {
                $distincted_result[] = $rowset;
            }
        }
        return $distincted_result;

    }
    
    public function getLessonsByGradeSubjectAndTime($grade_id, $subject_id, $timeS, $timeE)
    {
        $grade_id  = (int) $grade_id;
        $subject_id  = (int) $subject_id;
        $dateS = date("Y-m-d", $timeS);
        $dateE = date("Y-m-d", $timeE);
        
        $select = $this->tableGateway->getSql()->select();
        $where = $select->where;
        $where->equalTo('grade_id', $grade_id);
        $where->equalTo('subject_id', $subject_id);
        $where->between('date', $dateS, $dateE);
        $select->order('date DESC');

        $rowset = $this->tableGateway->selectWith($select);
        $records = array();
        foreach ($rowset as $row)
        {
            $records[] = $row;
        }
        return $records;
    }
    
    
}