<?php

namespace App\Repository;

use App\Entity\WeeklyOrderableProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WeeklyOrderableProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeeklyOrderableProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeeklyOrderableProduct[]    findAll()
 * @method WeeklyOrderableProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeeklyOrderableProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeeklyOrderableProduct::class);
    }

    // /**
    //  * @return WeeklyOrderableProduct[] Returns an array of WeeklyOrderableProduct objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WeeklyOrderableProduct
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
