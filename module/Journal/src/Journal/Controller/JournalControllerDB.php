<?php
namespace Journal\Controller;

use Zend\View\Model\ViewModel;

class JournalControllerDB extends TableController
{
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
        
        $rowset = $this->getGradeTable()
                ->getGradeJournalBySubjectInDateRange($grade, $subject, $date_from, $date_to);
        
        $records = array();
        foreach ($rowset as $row)
        {
            $records[] = array(
                'unit_id' => $row->units[0]->id,
                'unit_fullname' => $row->units[0]->fullname,
                'lesson_id' => $row->lessons[0]->id,
                'lesson_date' => new \DateTime($row->lessons[0]->date),
                'mark_value' => $row->marks[0]->value,
            );
        }
        
        return new ViewModel(array(
            'grade' => $grade,
            'subject' => $subject,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'results' => $records,
        ));
    }
    
}


