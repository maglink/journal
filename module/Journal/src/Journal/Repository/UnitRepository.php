<?php

namespace Journal\Repository;

use Doctrine\ORM\EntityRepository;

class UnitRepository extends EntityRepository {
    
    public function getAllTotalAvgMarksByMonth($unit, $month)    {

        $date_from = new \DateTime(date('Y-m-01',$month));
        $date_to = new \DateTime(date('Y-m-t',$month));
        
        $qb = $this->_em->createQueryBuilder();
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
        $query->useResultCache('unit_'.$unit->id.'_total_marks_in_'.$date_from->format("m"));
        $arrResults = $query->getArrayResult();
        
        return $arrResults;
    }
}