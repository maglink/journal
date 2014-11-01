<?php
namespace Journal\Model;
 
use Zend\Db\TableGateway\TableGateway;
 
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
    
    public function saveGrade(Grade $grade)
    {
        $data = array(
            'level' => $grade->level,
            'prefix'  => $grade->prefix,
        );
 
        $id = (int)$grade->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getGrade($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }
 
    public function deleteGrade($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}