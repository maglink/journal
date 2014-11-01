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
        return new ViewModel(array(
            'subjects' => $this->getSubjectTable()->getSubjectsByGrade($grade_id),
            'grade' => $this->getGradeTable()->getGrade($grade_id),
        ));
    }

}


