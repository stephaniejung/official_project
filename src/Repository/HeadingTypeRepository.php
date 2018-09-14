<?php

namespace App\Repository;

use App\Entity\HeadingType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HeadingType|null find($id, $lockMode = null, $lockVersion = null)
 * @method HeadingType|null findOneBy(array $criteria, array $orderBy = null)
 * @method HeadingType[]    findAll()
 * @method HeadingType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HeadingTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HeadingType::class);
    }

//    /**
//     * @return HeadingType[] Returns an array of HeadingType objects
//     */
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
    public function findOneBySomeField($value): ?HeadingType
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
