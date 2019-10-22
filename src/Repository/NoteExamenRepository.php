<?php

namespace App\Repository;

use App\Entity\NoteExamen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NoteExamen|null find($id, $lockMode = null, $lockVersion = null)
 * @method NoteExamen|null findOneBy(array $criteria, array $orderBy = null)
 * @method NoteExamen[]    findAll()
 * @method NoteExamen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteExamenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NoteExamen::class);
    }

    // /**
    //  * @return NoteExamen[] Returns an array of NoteExamen objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NoteExamen
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
