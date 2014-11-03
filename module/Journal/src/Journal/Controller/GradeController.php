<?php
namespace Journal\Controller;

use Zend\View\Model\ViewModel;

class GradeController extends TableController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'grades' => $this->getGradeTable()->fetchAll(),
        ));
    }

    public function unitlistAction()
    {
        
        $grade_id = (int) $this->params()->fromRoute('id', 0);
        return new ViewModel(array(
            'units' => $this->getUnitTable()->getUnitsInGrade($grade_id),
            'grade' => $this->getGradeTable()->getGrade($grade_id),
        ));
    }

    public function subjectlistAction()
    {
        $grade_id = (int) $this->params()->fromRoute('id', 0);
        $lessons = $this->getLessonTable()->getSubjectsByGrade($grade_id);
        $subjects = array();
        foreach($lessons as $lesson)
        {
            $subject_id = $lesson->subject_id;
            $subjects[] = $this->getSubjectTable()->getSubject($subject_id);
        }
        return new ViewModel(array(
            'subjects' => $subjects,
            'grade' => $this->getGradeTable()->getGrade($grade_id),
        ));
    }

}


