<?php
namespace Journal\TestModel;
 
use Journal\Model\Subject;
use PHPUnit_Framework_TestCase;
 
class SubjectTest extends PHPUnit_Framework_TestCase
{
    public function testSubjectInitialState()
    {
        $subject = new Subject();
 
        $this->assertNull($subject->id, '"id" should initially be null');
        $this->assertNull($subject->name, '"name" should initially be null');
    }
    
    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $subject = new Subject();
        $data  = array('id' => 123,
                       'name'  => 'some name');
 
        $subject->exchangeArray($data);
 
        $this->assertSame($data['id'], $subject->id, '"id" was not set correctly');
        $this->assertSame($data['name'], $subject->name, '"name" was not set correctly');
    }
 
    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
    {
        $subject = new Subject();
 
        $subject->exchangeArray(array('id' => 123,
                                    'name'  => 'some name'));
        
        $subject->exchangeArray(array());
 
        $this->assertNull($subject->id, '"id" should have defaulted to null');
        $this->assertNull($subject->name, '"name" should have defaulted to null');
    } 
}

