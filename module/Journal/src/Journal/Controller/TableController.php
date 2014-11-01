<?php
namespace Journal\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TableController extends AbstractActionController
{
    protected $gradeTable;
    protected $unitTable;
    protected $subjectTable;
    protected $lessonTable;
    protected $markTable;
    
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