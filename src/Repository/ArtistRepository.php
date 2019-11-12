<?php

namespace App\Repository;

use App\Entity\Artist\Artist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Artist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artist[]    findAll()
 * @method Artist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artist::class);
    }

    // /**
    //  * @return Artist[] Returns an array of Artist objects
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

    public function findOrder($order)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();

        return $queryBuilder->select(array('art', 'a', 't'))
            ->from('App\Entity\Artist\Artist', 'art')
            ->innerJoin('art.albums', 'a')
            ->innerJoin('art.tracks', 't')
            ->orderBy($order, 'ASC')
            ->getQuery()
            ->getArrayResult();
    }

    public function findWhere($where)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();

        return $queryBuilder->select(array('t', 'a', 'art'))
            ->from('App\Entity\Artist\Artist', 'art')
            ->innerJoin('art.albums', 'a')
            ->innerJoin('art.tracks', 't')
            ->where('art.name LIKE :val')
            ->setParameter('val', $where)
            ->getQuery()
            ->getArrayResult();
    }

    /*
    public function findOneBySomeField($value): ?Artist
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
