<?php
namespace GradeTestModel;
 
use Journal\Model\GradeTable;
use Journal\Model\Grade;
use Zend\Db\ResultSet\ResultSet;
use PHPUnit_Framework_TestCase;
 
class GradeTableTest extends PHPUnit_Framework_TestCase
{
    public function testFetchAllReturnsAllGrades()
    {
        $resultSet        = new ResultSet();
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                           array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with()
                         ->will($this->returnValue($resultSet));
 
        $gradeTable = new GradeTable($mockTableGateway);
 
        $this->assertSame($resultSet, $gradeTable->fetchAll());
    }
    
    public function testCanRetrieveAnGradeByItsId()
    {
        $grade = new Grade();
        $grade->exchangeArray(array('id' => 123,
                                    'level'  => 10,
                                    'prefix'  => 'some prefix'));

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Grade());
        $resultSet->initialize(array($grade));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));

        $gradeTable = new GradeTable($mockTableGateway);

        $this->assertSame($grade, $gradeTable->getGrade(123));
    }

}