<?php

namespace App\Repository;

use App\Entity\Centrale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CentraleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Centrale::class);
    }

    public function findAllActive(): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.deletedAt IS NULL')
            ->getQuery()
            ->getResult();
    }
}
