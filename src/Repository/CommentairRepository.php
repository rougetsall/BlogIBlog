<?php

namespace App\Repository;

use App\Entity\Commentair;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commentair|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commentair|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commentair[]    findAll()
 * @method Commentair[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentairRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentair::class);
    }

    // /**
    //  * @return Commentair[] Returns an array of Commentair objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Commentair
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
