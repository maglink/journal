<?php
namespace Journal\Model;
 
use Zend\Db\TableGateway\TableGateway;
 
class SubjectTable
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
 
    public function getSubject($id)
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
        $rows = $this->tableGateway->select(array('grade_id' => $grade_id));
        $records = array();
        foreach ($rows as $row)
        {
            $records[] = $row;
        }
        return $records;
    }
}