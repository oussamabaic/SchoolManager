<?php

namespace App\Repository;

use App\Entity\NoteControle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NoteControle|null find($id, $lockMode = null, $lockVersion = null)
 * @method NoteControle|null findOneBy(array $criteria, array $orderBy = null)
 * @method NoteControle[]    findAll()
 * @method NoteControle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteControleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NoteControle::class);
    }

    // /**
    //  * @return NoteControle[] Returns an array of NoteControle objects
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
    public function findOneBySomeField($value): ?NoteControle
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
