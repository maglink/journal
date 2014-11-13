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

    public function testCanRetrieveAnSubjectByItsId()
    {
        $suject = new Subject();
        $suject->exchangeArray(array('id' => 123,
                                    'name'  => 'some name'));

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Subject());
        $resultSet->initialize(array($suject));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));

        $subjectTable = new SubjectTable($mockTableGateway);

        $this->assertSame($suject, $subjectTable->getSubject(123));
    }
    
    /**
     * @expectedException Exception
     */
    public function testExceptionIsThrownWhenGettingNonexistentSubject()
    {

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Subject());
        $resultSet->initialize(array());

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));
        
        $subjectTable = new SubjectTable($mockTableGateway);
        $subjectTable->getSubject(123);
    }
}