<?php

namespace Journal\Repository;

use Doctrine\ORM\EntityRepository;

class GradeRepository extends EntityRepository {
    
    public function getGradeJournalBySybjectInDateRange($grade, $subject, $date_from, $date_to)    {

        $qb = $this->_em->createQueryBuilder();  
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
        
        return $arrResults;
    }
}
