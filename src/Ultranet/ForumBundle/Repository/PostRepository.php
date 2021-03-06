<?php

namespace Ultranet\ForumBundle\Repository;

use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends \Doctrine\ORM\EntityRepository
{
  public function getPosts($nombreParPage, $page, $topic)
  {
    if ($page < 1) {
      throw new \InvalidArgumentException("L'argument ne peut pas être inférieur à 1 (valeur : " . $page . ")");
    }

    // Construction de la requete
    $query = $this->createQueryBuilder('p')
      ->where('p.topic = :topic')
      ->setParameter('topic', $topic)
      ->getQuery();

    // On definit le forum a partir duquel commencer la liste
    $query->setFirstResult(($page - 1) * $nombreParPage)
      // Ainsi que le nombre de forum a afficher
      ->setMaxResults($nombreParPage);

    // On retourne l'objete Paginator correspondant a la requete
    return new Paginator($query);
  }
}
