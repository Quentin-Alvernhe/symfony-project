<?php

namespace App\DataFixtures;

use App\Entity\Centrale;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CentraleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $noms = [
            'Avenir spe - le bloc',
            'CSMF',
            'SML',
            'UFML-S',
            'FMF',
        ];

        foreach ($noms as $index => $nom) {
            $centrale = new Centrale();
            $centrale->setName($nom);
            $centrale->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($centrale);
            $this->addReference('centrale_' . $index, $centrale);
        }

        $manager->flush();
    }
}
