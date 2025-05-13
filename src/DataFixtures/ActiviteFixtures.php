<?php

namespace App\DataFixtures;

use App\Entity\Activite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActiviteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $noms = [
            'Médicale',
            'Médico-chirurgicale',
            'Dermatologie esthétique',
        ];

        foreach ($noms as $index => $nom) {
            $activite = new Activite();
            $activite->setName($nom);
            $activite->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($activite);
            $this->addReference('activite_' . $index, $activite);
        }

        $manager->flush();
    }
}
