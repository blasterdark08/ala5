<?php

namespace App\Repository;

use App\Entity\Aantal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Aantal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aantal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aantal[]    findAll()
 * @method Aantal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AantalRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Aantal::class);
    }

    // /**
    //  * @return Aantal[] Returns an array of Aantal objects
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

    /*
    public function findOneBySomeField($value): ?Aantal
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
