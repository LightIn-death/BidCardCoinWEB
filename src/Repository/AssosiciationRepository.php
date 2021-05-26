<?php

namespace App\Repository;

use App\Entity\Assosiciation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Assosiciation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Assosiciation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Assosiciation[]    findAll()
 * @method Assosiciation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssosiciationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Assosiciation::class);
    }

    // /**
    //  * @return Assosiciation[] Returns an array of Assosiciation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Assosiciation
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
