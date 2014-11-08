<?php
namespace Journal\Controller;

use Zend\View\Model\ViewModel;

class UnitController extends EntityController
{
    public function indexAction()
    {
        $unit_id = (int) $this->params()->fromRoute('id', 0);
        
        $unit = $this->getRepository('Unit')->find($unit_id);
        if(!$unit) return $this->notFoundAction();
        $grade = $unit->grade;
        
        $month = strtotime('this month');
        $date_from = new \DateTime(date('Y-m-01',$month));
        $date_to = new \DateTime(date('Y-m-t',$month));
        
        $qb = $this->queryBuilder();
        $qb->select('s.name'.' AS subject_name');
        $qb->addSelect($qb->expr()->avg('m.value').' AS mark_avg');
        $qb->from('Journal\Entity\Mark', 'm');
        $qb->innerJoin('m.lesson', 'l');
        $qb->innerJoin('l.subject', 's');
        $qb->where('m.unit = :unit');
        $qb->andWhere($qb->expr()->between('l.date', ':date_from', ':date_to'));
        $qb->groupBy('s');
        $qb->setParameter('unit', $unit);
        $qb->setParameter('date_from', $date_from, \Doctrine\DBAL\Types\Type::DATETIME);
        $qb->setParameter('date_to', $date_to, \Doctrine\DBAL\Types\Type::DATETIME);

        $query = $qb->getQuery();
        $query->useResultCache('unit_'.$unit_id.'_marks_avg');
        $marks = $query->getArrayResult();

        return new ViewModel(array(
            'unit' => $unit,
            'grade' => $unit->grade,
            'month' => $month,
            'marks' => $marks,
        ));
    }
}