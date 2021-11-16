<?php

namespace App\Repository;

use App\Entity\Hotel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Hotel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hotel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hotel[]    findAll()
 * @method Hotel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HotelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hotel::class);
    }

    // /**
    //  * @return Hotel[] Returns an array of Hotel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Hotel
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function last(): ?Hotel
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->addOrderBy('h.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findHotelReviewsByDateGroup($hotelId, $fromDate, $toDate, $startDailyRange, $startWeeklyRange)
    {
        $queryBuilder = $this->createQueryBuilder('h')
            ->select("count(r.id) as reviewCount,
                sum(r.score)/count(r.id) averageScore,
                case when r.created_date >= :startDailyRange then r.created_date 
                     when r.created_date < :startDailyRange and r.created_date >= :startWeeklyRange then DATE_FORMAT(r.created_date,'Year %Y | Week %V') 
                     else DATE_FORMAT(r.created_date,'%Y-%M') 
                end as dateGroup")
            ->where('h.id = :hotelId')
            ->join("h.reviews","r")
            ->groupBy('dateGroup')
            ->orderBy("r.created_date", "asc")
            ->setParameter('hotelId', $hotelId)
            ->setParameter('startDailyRange', $startDailyRange)
            ->setParameter('startWeeklyRange', $startWeeklyRange);

        if ($fromDate){
            $queryBuilder
                ->andWhere('r.created_date >= :fromDate')
                ->setParameter('fromDate', $fromDate->setTime(0, 0, 0));
        }

        if ($toDate){
            $queryBuilder
                ->andWhere('r.created_date <= :toDate')
                ->setParameter('toDate', $toDate->setTime(23, 59, 59));
        }

        return $queryBuilder->getQuery()->execute();
    }
}
