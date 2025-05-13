<?php

namespace App\Repository;

use App\Entity\Statut;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class StatutRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Statut::class);
    }

    public function findAllActive(): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.deletedAt IS NULL')
            ->getQuery()
            ->getResult();
    }
}
