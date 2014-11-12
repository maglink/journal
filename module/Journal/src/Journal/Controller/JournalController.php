<?php
namespace Journal\Controller;

use Zend\View\Model\ViewModel;

class JournalController extends EntityController
{
    public function indexAction()
    {
        $grade_id = (int) $this->params()->fromRoute('grade_id', 0);
        $subject_id = (int) $this->params()->fromRoute('subject_id', 0);
        $date = (string) $this->params()->fromRoute('date', date('Y-m-d',time()));

        $grade = $this->getRepository('Grade')->find($grade_id);
        $subject = $this->getRepository('Subject')->find($subject_id);
        if(!$grade or !$subject) return $this->notFoundAction();

        $time_from = strtotime('last monday', strtotime('tomorrow', strtotime($date)));
        $time_to = strtotime('+6 days', $time_from);
        $date_from = new \DateTime(date('Y-m-d',$time_from));
        $date_to = new \DateTime(date('Y-m-d',$time_to));
        
        $arrResults = $this->getRepository('Grade')
                ->getGradeJournalBySybjectInDateRange($grade, $subject, $date_from, $date_to);       

        return new ViewModel(array(
            'grade' => $grade,
            'subject' => $subject,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'results' => $arrResults,
        ));

    }
}


