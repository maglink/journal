<?php
namespace Journal\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class JournalControllerDB extends AbstractActionController
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
        $date = (string) $this->params()->fromRoute('date', date('Y-m-d',time()));
        
        $grade = $this->getGradeTable()->getGrade($grade_id);
        $subject = $this->getSubjectTable()->getSubject($subject_id);
        if(!$grade or !$subject) return $this->notFoundAction();
        
        $time_from = strtotime('last monday', strtotime('tomorrow', strtotime($date)));
        $time_to = strtotime('+6 days', $time_from);
        $date_from = new \DateTime(date('Y-m-d',$time_from));
        $date_to = new \DateTime(date('Y-m-d',$time_to));
        
        $arrResults = $this->getGradeTable()
                ->getGradeJournalBySybjectInDateRange($grade, $subject, $date_from, $date_to);
        
        return new ViewModel(array(
            'grade' => $grade,
            'subject' => $subject,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'results' => $arrResults,
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


