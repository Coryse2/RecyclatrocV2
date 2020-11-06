<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\Location;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;


/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    // /**
    // * @return Product[] Returns an array of Product objects
    //*/

    public function findAll()
    {
        return $this->createQueryBuilder('p')
            ->addOrderBy('p.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findFive()
    {
        return $this->createQueryBuilder('p')
            ->addOrderBy('p.createdAt', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    public function searchCategory($critere)
    {
        return $this->createQueryBuilder('p')
            ->Where('p.category = :category')
            ->setParameter('category', $critere['category'])
            ->getQuery()
            ->getResult();
    }

    public function searchByCity($critere)
    {
        return $this->createQueryBuilder('p')
            ->Where('p.location = :location')
            ->setParameter('location', $critere['location'])
            ->getQuery()
            ->getResult();
    }


}
