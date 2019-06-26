<?php

namespace App\Repository;

use App\Entity\Reservering;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Reservering|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservering|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservering[]    findAll()
 * @method Reservering[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReserveringRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Reservering::class);
    }

    // select iedereeen die inchecked
    public function getCheckIn(\Datetime $date)
    {
        //maak datum
        $from = new \DateTime($date->format("Y-m-d")." 00:00:00");

        // create query
        $qb = $this->createQueryBuilder("e");
        $qb
            ->andWhere('e.start = :from ')
            ->setParameter('from', $from )
        ;
        $result = $qb->getQuery()->getResult();

        return $result;
    }
    // select iedereeen die uitchecked
    public function getCheckOut(\Datetime $date)
    {
        //maak datum
        $to = new \DateTime($date->format("Y-m-d")." 00:00:00");

        // create query
        $qb = $this->createQueryBuilder("e");
        $qb
            ->andWhere('e.eind = :to ')
            ->setParameter('to', $to )
        ;
        $result = $qb->getQuery()->getResult();

        return $result;
    }
    // /**
    //  * @return Reservering[] Returns an array of Reservering objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Reservering
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
