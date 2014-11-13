<?php
namespace MarkTestModel;
 
use Journal\Model\MarkTable;
use Journal\Model\Mark;
use Zend\Db\ResultSet\ResultSet;
use PHPUnit_Framework_TestCase;
 
class MarkTableTest extends PHPUnit_Framework_TestCase
{
    
    public function testGettingMarkByUnitAndLesson()
    {
        $mark = new Mark();
        $mark->exchangeArray(array('unit_id' => 1,
                                    'lesson_id'  => 2,
                                    'value'  => 3));

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Mark());
        $resultSet->initialize(array($mark));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', 
                                            array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('unit_id' => 1, 'lesson_id' => 2))
                         ->will($this->returnValue($resultSet));
        
        $markTable = new MarkTable($mockTableGateway);

        $this->assertSame($mark->value, $markTable->getMarkValueByUnitAndLesson(1,2));
    }

    public function testExceptionIsThrownWhenGettingNonexistentMark()
    {

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Mark());
        $resultSet->initialize(array());

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', 
                                            array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('unit_id' => 1, 'lesson_id' => 2))
                         ->will($this->returnValue($resultSet));
        
        $markTable = new MarkTable($mockTableGateway);

        $this->assertEquals(null, $markTable->getMarkValueByUnitAndLesson(1,2));
    }
    
}