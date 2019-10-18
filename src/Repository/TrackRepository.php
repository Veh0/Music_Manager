<?php

namespace App\Repository;

use App\Entity\Media\MediumInterface;
use App\Entity\Track\Track;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Track|null find($id, $lockMode = null, $lockVersion = null)
 * @method Track|null findOneBy(array $criteria, array $orderBy = null)
 * @method Track[]    findAll()
 * @method Track[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Track::class);
    }

    /**
     * @param
     * @return MediumInterface[] Returns an array of MediumInterface objects
     */
    public function findMediaByTitle($title)
    {
        return $this->createQueryBuilder('t')
            ->select('t.media')
            ->andWhere('t.title = :val')
            ->setParameter('val', $title)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getArrayResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Track
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
