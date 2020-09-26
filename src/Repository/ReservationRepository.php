<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    // /**
    //  * @return Reservation[] Returns an array of Reservation objects
    //  */

    public function findMonth($first, $last)
    {
        return $this->createQueryBuilder('r')
            ->where('r.dateRDV > :first')
            ->andWhere('r.dateRDV < :last')
            ->setParameter('first', $first)
            ->setParameter('last', $last)
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findReservationTokken($coiffeurId, $date)
    {
        return $this->createQueryBuilder('r')
            ->where('r.coiffeur = :coiffeurId')
            ->andWhere('r.dateRDV = :date')
            ->setParameter('coiffeurId', $coiffeurId)
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findReservationTokkenDay($coiffeurId, $date)
    {
        return $this->createQueryBuilder('r')
            ->where('r.coiffeur = :coiffeurId')
            ->andWhere('r.dateRDV > :dateFirst')
            ->andWhere('r.dateRDV < :dateLast')
            ->setParameter('coiffeurId', $coiffeurId)
            ->setParameter('dateFirst', "$date 01:00:00")
            ->setParameter('dateLast', "$date 23:00:00")
            ->getQuery()
            ->getResult()
        ;
    }
    
    /*
    public function findOneBySomeField($value): ?Reservation
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
