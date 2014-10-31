<?php
namespace Journal\TestModel;
 
use Journal\Model\Lesson;
use PHPUnit_Framework_TestCase;
 
class LessonTest extends PHPUnit_Framework_TestCase
{
    public function testLessonInitialState()
    {
        $lesson = new Lesson();
 
        $this->assertNull($lesson->id, '"id" should initially be null');
        $this->assertNull($lesson->grade_id, '"grade_id" should initially be null');
        $this->assertNull($lesson->subject_id, '"subject_id" should initially be null');
        $this->assertNull($lesson->date, '"date" should initially be null');
    }
    
    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $lesson = new Lesson();
        $data  = array('id' => 123,
                       'grade_id'  => 10,
                       'subject_id'  => 10,
                       'date'  => '1980-10-11');
 
        $lesson->exchangeArray($data);
 
        $this->assertSame($data['id'], $lesson->id, '"id" was not set correctly');
        $this->assertSame($data['grade_id'], $lesson->grade_id, '"grade_id" was not set correctly');
        $this->assertSame($data['subject_id'], $lesson->subject_id, '"subject_id" was not set correctly');
        $this->assertSame($data['date'], $lesson->date, '"date" was not set correctly');
    }
 
    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
    {
        $lesson = new Lesson();
 
        $lesson->exchangeArray(array('id' => 123,
                                    'grade_id'  => 10,
                                    'subject_id'  => 10,
                                    'date'  => '1980-10-11'));
        
        $lesson->exchangeArray(array());
 
        $this->assertNull($lesson->id, '"id" should have defaulted to null');
        $this->assertNull($lesson->grade_id, '"grade_id" should have defaulted to null');
        $this->assertNull($lesson->subject_id, '"subject_id" should have defaulted to null');
        $this->assertNull($lesson->date, '"date" should have defaulted to null');
    } 
}

