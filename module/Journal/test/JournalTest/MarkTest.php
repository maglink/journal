<?php
namespace Journal\TestModel;
 
use Journal\Model\Mark;
use PHPUnit_Framework_TestCase;
 
class MarkTest extends PHPUnit_Framework_TestCase
{
    public function testMarkInitialState()
    {
        $mark = new Mark();
 
        $this->assertNull($mark->unit_id, '"unit_id" should initially be null');
        $this->assertNull($mark->lesson_id, '"lesson_id" should initially be null');
        $this->assertNull($mark->value, '"value" should initially be null');
    }
    
    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $mark = new Mark();
        $data  = array('unit_id' => 123,
                       'lesson_id'  => 10,
                       'value'  => 5);
 
        $mark->exchangeArray($data);
 
        $this->assertSame($data['unit_id'], $mark->unit_id, '"unit_id" was not set correctly');
        $this->assertSame($data['lesson_id'], $mark->lesson_id, '"lesson_id" was not set correctly');
        $this->assertSame($data['value'], $mark->value, '"value" was not set correctly');
    }
 
    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
    {
        $mark = new Mark();
 
        $mark->exchangeArray(array('unit_id' => 123,
                                    'lesson_id'  => 10,
                                    'value'  => 5));
        
        $mark->exchangeArray(array());
 
        $this->assertNull($mark->unit_id, '"unit_id" should have defaulted to null');
        $this->assertNull($mark->lesson_id, '"lesson_id" should have defaulted to null');
        $this->assertNull($mark->value, '"value" should have defaulted to null');
    } 
}

