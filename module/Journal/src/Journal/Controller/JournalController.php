<?php
namespace Journal\Controller;

use Zend\View\Model\ViewModel;

class JournalController extends TableController
{
    public function indexAction()
    {
        $grade_id = (int) $this->params()->fromRoute('grade_id', 0);
        $subject_id = (int) $this->params()->fromRoute('subject_id', 0);
        $time = (int) $this->params()->fromRoute('time', time());

        $timeS = strtotime('last monday', strtotime('tomorrow', $time));
        $timeE = strtotime('+6 days', $timeS);

        $grade = $this->getGradeTable()->getGrade($grade_id);
        $subject = $this->getSubjectTable()->getSubject($subject_id);
        $lessons = $this->getLessonTable()->getLessonsByGradeSubjectAndTime($grade_id, $subject_id, $timeS, $timeE);
        $units = $this->getUnitTable()->getUnitsInGrade($grade_id);

        $arrDates = array();
        foreach ($lessons as $lesson):
            $arrDates[] = date_create($lesson->date);
        endforeach;
        
        $arrUnits = $this->getArrUnits($units, $lessons);

        return new ViewModel(array(
            'grade' => $grade,
            'subject' => $subject,
            'dates' => $arrDates,
            'units' => $arrUnits,
            'timeS' => $timeS,
            'timeE' => $timeE,
        ));
    }
    
    private function getArrUnits($units, $lessons)
    {
        $arrUnits = array();
        foreach ($units as $unit):
            $arrMarks = array();
            foreach ($lessons as $lesson):
                $mark = $this->getMarkTable()->getMarkValueByUnitAndLesson($unit->id, $lesson->id);
                $arrMarks[] = array(
                    'lesson' => $lesson,
                    'mark' => $mark,
                );
            endforeach;
            $arrUnits[] = array(
                'unit' => $unit,
                'marks' => $arrMarks,
            );
        endforeach; 
        return $arrUnits;
    }
}


