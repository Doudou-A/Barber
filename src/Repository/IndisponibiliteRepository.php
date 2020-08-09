<?php

namespace App\Repository;

use App\Entity\Indisponibilite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Indisponibilite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Indisponibilite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Indisponibilite[]    findAll()
 * @method Indisponibilite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndisponibiliteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Indisponibilite::class);
    }

    // /**
    //  * @return Indisponibilite[] Returns an array of Indisponibilite objects
    //  */

    public function findIndispoOne($coiffeur, $dateTime)
    {
        return $this->createQueryBuilder('r')
        ->where('r.coiffeur = :coiffeurId')
        ->andWhere('r.dateIndispo = :date')
        ->setParameter('coiffeurId', $coiffeur)
        ->setParameter('date', $dateTime)
        ->getQuery()
        ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Indisponibilite
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
