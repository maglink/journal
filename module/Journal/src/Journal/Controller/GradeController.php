<?php
namespace Journal\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class GradeController extends AbstractActionController
{
    protected $gradeTable;
    protected $unitTable;
    protected $subjectTable;
    
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

}


