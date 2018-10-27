<?php

namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Manager;
use App\Entity\Siege;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Siege|null find($id, $lockMode = null, $lockVersion = null)
 * @method Siege|null findOneBy(array $criteria, array $orderBy = null)
 * @method Siege[]    findAll()
 * @method Siege[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SiegeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Siege::class);
    }

    public function findAttachedManagers($currentuserid){

        $query = $this->getEntityManager()->createQuery('
            select m
            FROM App\Entity\Manager m 
            WHERE m.Siege = :currentuserid'
        )->setParameter('currentuserid', $currentuserid);

        return $query->execute();
    }
//    /**
//     * @return Siege[] Returns an array of Siege objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Siege
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
