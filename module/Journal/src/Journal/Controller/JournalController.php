<?php
namespace Journal\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class JournalController extends AbstractActionController
{
    protected $gradeTable;
    protected $unitTable;
    protected $subjectTable;
    protected $lessonTable;
    protected $markTable;
    
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
        
        $arrUnits = array();
        foreach ($units as $unit):
            $arrMarks = array();
            foreach ($lessons as $lesson):
                $mark = $this->getMarkTable()->getMarkByUnitAndLesson($unit->id, $lesson->id);
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

        return new ViewModel(array(
            'grade' => $grade,
            'subject' => $subject,
            'dates' => $arrDates,
            'units' => $arrUnits,
            'time' => $time,
            'timeS' => $timeS,
            'timeE' => $timeE,
        ));
    }

     public function getGradeTable()
    {
        if (!$this->gradeTable) {
            $sm = $this->getServiceLocator();
            $this->gradeTable = $sm->get('Journal\Model\GradeTable');
        }
        return $this->gradeTable;
    }
    
    public function getUnitTable()
    {
        if (!$this->unitTable) {
            $sm = $this->getServiceLocator();
            $this->unitTable = $sm->get('Journal\Model\UnitTable');
        }
        return $this->unitTable;
    }
    
    public function getSubjectTable()
    {
        if (!$this->subjectTable) {
            $sm = $this->getServiceLocator();
            $this->subjectTable = $sm->get('Journal\Model\SubjectTable');
        }
        return $this->subjectTable;
    }
    
    public function getLessonTable()
    {
        if (!$this->lessonTable) {
            $sm = $this->getServiceLocator();
            $this->lessonTable = $sm->get('Journal\Model\LessonTable');
        }
        return $this->lessonTable;
    }
    
    public function getMarkTable()
    {
        if (!$this->markTable) {
            $sm = $this->getServiceLocator();
            $this->markTable = $sm->get('Journal\Model\MarkTable');
        }
        return $this->markTable;
    }
}


