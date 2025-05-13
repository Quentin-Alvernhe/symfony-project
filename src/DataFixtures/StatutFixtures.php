<?php

namespace App\DataFixtures;

use App\Entity\Statut;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatutFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $noms = [
            'Libéral',
            'Hospitalier',
            'Mixte',
            'Retraité',
            'Remplaçant',
            'Salarié',
            'Cumul emploi retraite',
        ];

        foreach ($noms as $index => $nom) {
            $statut = new Statut();
            $statut->setName($nom);
            $statut->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($statut);
            $this->addReference('statut_' . $index, $statut);
        }

        $manager->flush();
    }
}
