<?php

namespace App\Repository;

use App\Entity\ForecastSummary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ForecastSummary>
 *
 * @method ForecastSummary|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForecastSummary|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForecastSummary[]    findAll()
 * @method ForecastSummary[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForecastSummaryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForecastSummary::class);
    }

//    /**
//     * @return ForecastSummary[] Returns an array of ForecastSummary objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ForecastSummary
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
