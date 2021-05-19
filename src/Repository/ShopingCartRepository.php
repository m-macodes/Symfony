<?php

namespace App\Repository;

use App\Entity\ShopingCart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ShopingCart|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShopingCart|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShopingCart[]    findAll()
 * @method ShopingCart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShopingCartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShopingCart::class);
    }

    // /**
    //  * @return ShopingCart[] Returns an array of ShopingCart objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ShopingCart
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
