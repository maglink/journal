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

}