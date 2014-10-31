<?php
namespace Journal\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UnitController extends AbstractActionController
{
    protected $unitTable;
    protected $gradeTable;
    
    public function indexAction()
    {
       $id = (int) $this->params()->fromRoute('id', 0);
       $unit = $this->getUnitTable()->getUnit($id);
       $grade = $this->getGradeTable()->getGrade($unit->grade_id);
       return new ViewModel(array(
            'unit' => $unit,
            'grade' => $grade,
        ));
    }

    public function getUnitTable()
    {
        if (!$this->unitTable) {
            $sm = $this->getServiceLocator();
            $this->unitTable = $sm->get('Journal\Model\UnitTable');
        }
        return $this->unitTable;
    }
    
    public function getGradeTable()
    {
        if (!$this->gradeTable) {
            $sm = $this->getServiceLocator();
            $this->gradeTable = $sm->get('Journal\Model\GradeTable');
        }
        return $this->gradeTable;
    }
}