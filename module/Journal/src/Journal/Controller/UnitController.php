<?php
namespace Journal\Controller;

use Zend\View\Model\ViewModel;

class UnitController extends TableController
{
    public function indexAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        $unit = $this->getUnitTable()->getUnit($id);
        $grade = $this->getGradeTable()->getGrade($unit->grade_id);

        $month = strtotime('this month');
        $timeS = strtotime(date('Y-m-01',$month));
        $timeE = strtotime(date('Y-m-t',$month));

        $lessons = $this->getLessonTable()->getSubjectsByGrade($grade->id);
        $subjects = array();
        foreach($lessons as $lesson)
        {
            $subject_id = $lesson->subject_id;
            $subjects[] = $this->getSubjectTable()->getSubject($subject_id);
        }
        
        $marks = array();
        foreach($subjects as $subject)
        {
            $count = 0;
            $sum = 0;
            $lessons = $this->getLessonTable()->getLessonsByGradeSubjectAndTime(
                    $grade->id, $subject->id, $timeS, $timeE);
            foreach($lessons as $lesson)
            {
                $markValue = $this->getMarkTable()->getMarkValueByUnitAndLesson(
                        $unit->id, $lesson->id);
                if((int)$markValue > 0)
                {
                    $count++;
                    $sum+=(int)$markValue;
                }
            }     
            $marks[] = array(
                'subject' => $subject,
                'avg' => $count==0?0:$sum/$count,
            );
        }

        return new ViewModel(array(
            'unit' => $unit,
            'grade' => $grade,
            'marks' => $marks,
            'month' => $month,
        ));
    }
}