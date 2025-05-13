<?php

namespace App\DataFixtures;

use App\Entity\Periode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PeriodeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $years = [2024, 2025, 2026];

        foreach ($years as $year) {
            $periode = new Periode();
            $periode->setName((string) $year)
                    ->setStartedAt(new \DateTimeImmutable("$year-01-01"))
                    ->setEndAt(new \DateTimeImmutable("$year-12-31"));

            $manager->persist($periode);
            $this->addReference('periode_' . $year, $periode);
        }

        $manager->flush();
    }
}
