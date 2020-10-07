<?php

namespace App\Repository;

use App\Entity\UsersToTeam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UsersToTeam|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsersToTeam|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsersToTeam[]    findAll()
 * @method UsersToTeam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersToTeamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsersToTeam::class);
    }

    // /**
    //  * @return UsersToTeam[] Returns an array of UsersToTeam objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UsersToTeam
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
