<?php

namespace App\Repository;

use App\Entity\WyrazeniaAlgebraiczne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WyrazeniaAlgebraiczne>
 */
class WyrazeniaAlgebraiczneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WyrazeniaAlgebraiczne::class);
    }

    public function findRandom(int $limit = 1): array
    {
        $count = $this->count([]);
        if ($count === 0) {
            return [];
        }
    
        $idsResult = $this->createQueryBuilder('la')
            ->select('la.id')
            ->getQuery()
            ->getArrayResult();
    
        $ids = array_column($idsResult, 'id');
    
        // Losowanie unikalnych ID
        if ($limit >= $count) {
            $randomIds = $ids;
        } else {
            $randomIds = (array) array_rand(array_flip($ids), $limit);
        }
    
        // Pobieranie rekordów o wylosowanych ID
        return $this->createQueryBuilder('la')
            ->where('la.id IN (:ids)')
            ->setParameter('ids', $randomIds)
            ->getQuery()
            ->getResult();
    }

    //    public function findOneBySomeField($value): ?LinearAlgebra
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
