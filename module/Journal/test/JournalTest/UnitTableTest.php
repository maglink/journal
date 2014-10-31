<?php
namespace UnitTestModel;
 
use Journal\Model\UnitTable;
use Journal\Model\Unit;
use Zend\Db\ResultSet\ResultSet;
use PHPUnit_Framework_TestCase;

class UnitTableTest extends PHPUnit_Framework_TestCase
{
    public function testFetchAllReturnsAllUnits()
    {
        $resultSet        = new ResultSet();
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                           array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with()
                         ->will($this->returnValue($resultSet));
 
        $unitTable = new UnitTable($mockTableGateway);
 
        $this->assertSame($resultSet, $unitTable->fetchAll());
    }
    
    public function testCanRetrieveAnUnitByItsId()
    {
        $unit = new Unit();
        $unit->exchangeArray(array('id' => 123,
                                    'grade_id'  => 10,
                                    'fullname'  => 'some fullname'));

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Unit());
        $resultSet->initialize(array($unit));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));

        $unitTable = new UnitTable($mockTableGateway);

        $this->assertSame($unit, $unitTable->getUnit(123));
    }
    
    public function testGettingUnitsInGradeByGradeId()
    {
        $unit1 = new Unit();
        $unit1->exchangeArray(array('id' => 50,
                                    'grade_id'  => 10,
                                    'fullname'  => 'some fullname'));
        
        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Unit());
        $resultSet->initialize(array($unit1));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('grade_id' => 10))
                         ->will($this->returnValue($resultSet));

        $unitTable = new UnitTable($mockTableGateway);
        
        $result = $unitTable->getUnitsInGrade(10);
        $this->assertSame(1, count($result));
        $this->assertSame(50, $result[0]->id);
    }

}