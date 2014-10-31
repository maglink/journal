<?php
namespace Journal\TestModel;
 
use Journal\Model\Grade;
use PHPUnit_Framework_TestCase;
 
class GradeTest extends PHPUnit_Framework_TestCase
{
    public function testGradeInitialState()
    {
        $grade = new Grade();
 
        $this->assertNull($grade->id, '"id" should initially be null');
        $this->assertNull($grade->level, '"level" should initially be null');
        $this->assertNull($grade->prefix, '"prefix" should initially be null');
    }
    
    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $grade = new Grade();
        $data  = array('id' => 123,
                       'level'  => 10,
                       'prefix'  => 'some prefix');
 
        $grade->exchangeArray($data);
 
        $this->assertSame($data['id'], $grade->id, '"id" was not set correctly');
        $this->assertSame($data['level'], $grade->level, '"level" was not set correctly');
        $this->assertSame($data['prefix'], $grade->prefix, '"prefix" was not set correctly');
    }
 
    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
    {
        $grade = new Grade();
 
        $grade->exchangeArray(array('id' => 123,
                                    'level'  => 10,
                                    'prefix'  => 'some prefix'));
        
        $grade->exchangeArray(array());
 
        $this->assertNull($grade->id, '"id" should have defaulted to null');
        $this->assertNull($grade->level, '"level" should have defaulted to null');
        $this->assertNull($grade->prefix, '"prefix" should have defaulted to null');
    } 
}

