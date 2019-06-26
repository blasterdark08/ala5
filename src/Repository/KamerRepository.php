<?php

namespace App\Repository;

use App\Entity\Kamer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Kamer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kamer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kamer[]    findAll()
 * @method Kamer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KamerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Kamer::class);
    }


    public function findPrice($start , $eind, $pers): array
    {
        $conn = $this->getEntityManager()->getConnection();

       $sql = '
SELECT 
    k.id, k.prijs, y.aantal_personen, y.foto
FROM 
    kamer as k
LEFT JOIN 
     reservering as b
     ON (
         b.kamer_id = k.id AND 
         NOT ( 
             (b.start < :start and b.eind < :start) 
             OR
             (b.start > :eind and b.eind > :eind) 
             )
        ) 

INNER JOIN 
    type as y
    on( y.id = k.type_id  )
 
WHERE 
y.aantal_personen >= :pers
AND
    b.kamer_id IS NULL
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['start' => $start, 'eind' => $eind, 'pers' => $pers]);

        return $stmt->fetchAll();
    }

    // /**
    //  * @return Kamer[] Returns an array of Kamer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Kamer
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
