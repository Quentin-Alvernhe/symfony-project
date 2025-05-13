<?php

namespace App\Repository;

use App\Entity\Adresse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AdresseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Adresse::class);
    }

    public function findAllActive(): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.deletedAt IS NULL')
            ->getQuery()
            ->getResult();
    }
}
