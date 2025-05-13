<?php

namespace App\DataFixtures;

use App\Entity\Secteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SecteurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $noms = [
            'Secteur 1',
            'Secteur 2',
            'Secteur 3',
            'Secteur 1 OPTAM',
            'Secteur 2 OPTAM',
        ];

        foreach ($noms as $index => $nom) {
            $secteur = new Secteur();
            $secteur->setName($nom);
            $secteur->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($secteur);
            $this->addReference('secteur_' . $index, $secteur);
        }

        $manager->flush();
    }
}
