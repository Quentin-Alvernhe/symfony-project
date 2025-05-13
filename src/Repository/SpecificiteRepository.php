<?php

namespace App\Repository;

use App\Entity\Specificite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SpecificiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Specificite::class);
    }

    public function findAllActive(): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.deletedAt IS NULL')
            ->getQuery()
            ->getResult();
    }
}
