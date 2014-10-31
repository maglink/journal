<?php
namespace Journal\Model;
 
use Zend\Db\TableGateway\TableGateway;
 
class LessonTable
{
    protected $tableGateway;
 
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
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