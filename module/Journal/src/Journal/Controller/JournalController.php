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

        $qb = $this->queryBuilder();
        $qb->select('u.id'.' AS unit_id');
        $qb->addSelect('u.fullname'.' AS unit_fullname');
        $qb->addSelect('L.id'.' AS lesson_id');
        $qb->addSelect('L.date'.' AS lesson_date');
        $qb->addSelect('m.value'.' AS mark_value');
        $qb->from('Journal\Entity\Grade', 'g');
        $qb->innerJoin('g.units', 'u');
        $qb->innerJoin('g.lessons', 'L');
        $qb->leftJoin('u.marks', 'm', 'WITH', 'm.lesson = L');
        $qb->where('g = :grade');
        $qb->andWhere('L.subject = :subject');
        $qb->andWhere($qb->expr()->between('L.date', ':date_from', ':date_to'));
        $qb->orderBy('u.fullname');
        $qb->addOrderBy('L.date');
        $qb->setParameter('grade', $grade);
        $qb->setParameter('subject', $subject);
        $qb->setParameter('date_from', $date_from, \Doctrine\DBAL\Types\Type::DATETIME);
        $qb->setParameter('date_to', $date_to, \Doctrine\DBAL\Types\Type::DATETIME);
        
        $query = $qb->getQuery();
        $arrResults = $query->getArrayResult();        

        return new ViewModel(array(
            'grade' => $grade,
            'subject' => $subject,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'results' => $arrResults,
        ));

    }
}


