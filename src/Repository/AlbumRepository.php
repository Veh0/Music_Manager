<?php

namespace App\Repository;

use App\Entity\Album\Album;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Album|null find($id, $lockMode = null, $lockVersion = null)
 * @method Album|null findOneBy(array $criteria, array $orderBy = null)
 * @method Album[]    findAll()
 * @method Album[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlbumRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Album::class);
    }

    /**
     * @param array $media
     * @return Album[] Returns an array of Album objects
     */
    public function findByMedia(array $media)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.media IN :val')
            ->setParameter('val', $media )
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOrder($order)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();

        return $queryBuilder->select(array('a', 'm', 'art'))
            ->from('App\Entity\Album\Album', 'a')
            ->innerJoin('a.media', 'm')
            ->innerJoin('a.artist', 'art')
            ->orderBy($order, 'ASC')
            ->getQuery()
            ->getArrayResult();
    }

    public function findWhere($where)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();

        return $queryBuilder->select(array('a', 'm', 'art'))
            ->from('App\Entity\Album\Album', 'a')
            ->innerJoin('a.media', 'm')
            ->innerJoin('a.artist', 'art')
            ->where('a.title LIKE :val')
            ->setParameter('val', $where)
            ->getQuery()
            ->getArrayResult();
    }

    /*
    public function findOneBySomeField($value): ?Album
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
