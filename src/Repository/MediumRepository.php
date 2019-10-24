<?php

namespace App\Repository;

use App\Entity\Media\Medium;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Medium|null find($id, $lockMode = null, $lockVersion = null)
 * @method Medium|null findOneBy(array $criteria, array $orderBy = null)
 * @method Medium[]    findAll()
 * @method Medium[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MediumRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Medium::class);
    }

    // /**
    //  * @return AbstractMedium[] Returns an array of AbstractMedium objects
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
    public function findOneBySomeField($value): ?AbstractMedium
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
