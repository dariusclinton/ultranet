<?php

namespace Ultranet\UserBundle\Repository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    public function getUserInformation($userId){
        $query = $this->_em->createQuery("SELECT u, f FROM Ultranet\UserBundle\User u JOIN u.formation WHERE u.id = :userId");
        $query->setParameter('userId', $userId);
        return $query->getResult();
    }
    
}