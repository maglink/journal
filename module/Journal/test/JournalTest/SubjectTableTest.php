<?php
namespace SubjectTestModel;
 
use Journal\Model\SubjectTable;
use Journal\Model\Subject;
use Zend\Db\ResultSet\ResultSet;
use PHPUnit_Framework_TestCase;
 
class SubjectTableTest extends PHPUnit_Framework_TestCase
{
    public function testFetchAllReturnsAllSubjects()
    {
        $resultSet        = new ResultSet();
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                           array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with()
                         ->will($this->returnValue($resultSet));
 
        $subjectTable = new SubjectTable($mockTableGateway);
 
        $this->assertSame($resultSet, $subjectTable->fetchAll());
    }
    
    public function testGettingSubjectsByGradeId()
    {
        $subject = new Subject();
        $subject->exchangeArray(array('id' => 123,
                                    'grade_id'  => 10,
                                    'name'  => 'some name'));

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Subject());
        $resultSet->initialize(array($subject));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('grade_id' => 10))
                         ->will($this->returnValue($resultSet));

        $subjectTable = new SubjectTable($mockTableGateway);

        $result = $subjectTable->getSubjectsByGrade(10);
        $this->assertSame(1, count($result));
        $this->assertSame(123, $result[0]->id);
    }
    
    
    


}