<?php
namespace Journal\TestModel;
 
use Journal\Model\Unit;
use PHPUnit_Framework_TestCase;
 
class UnitTest extends PHPUnit_Framework_TestCase
{
    public function testUnitInitialState()
    {
        $unit = new Unit();
 
        $this->assertNull($unit->id, '"id" should initially be null');
        $this->assertNull($unit->grade_id, '"grade_id" should initially be null');
        $this->assertNull($unit->fullname, '"fullname" should initially be null');
    }
    
    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $unit = new Unit();
        $data  = array('id' => 123,
                       'grade_id'  => 10,
                       'fullname'  => 'some fullname');
 
        $unit->exchangeArray($data);
 
        $this->assertSame($data['id'], $unit->id, '"id" was not set correctly');
        $this->assertSame($data['grade_id'], $unit->grade_id, '"grade_id" was not set correctly');
        $this->assertSame($data['fullname'], $unit->fullname, '"fullname" was not set correctly');
    }
 
    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
    {
        $unit = new Unit();
 
        $unit->exchangeArray(array('id' => 123,
                                    'grade_id'  => 10,
                                    'fullname'  => 'some fullname'));
        
        $unit->exchangeArray(array());
 
        $this->assertNull($unit->id, '"id" should have defaulted to null');
        $this->assertNull($unit->grade_id, '"grade_id" should have defaulted to null');
        $this->assertNull($unit->fullname, '"fullname" should have defaulted to null');
    } 
}

