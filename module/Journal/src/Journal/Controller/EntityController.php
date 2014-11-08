<?php
namespace Journal\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class EntityController extends AbstractActionController
{
    protected $em;
 
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }
    
    public function getRepository($repName)
    {
        return $this->getEntityManager()
                ->getRepository( 'Journal\Entity\\'. $repName);   
    }
    
    public function queryBuilder()
    {
        return $this->getEntityManager()
                ->createQueryBuilder();  
    }
    
}