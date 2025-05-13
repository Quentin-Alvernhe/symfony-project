<?php

namespace App\DataFixtures;

use App\Entity\Specificite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SpecificiteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $noms = [
            'Photothérapie UVA',
            'Photothérapie UVB',
            'PDT',
            'Chirurgie',
            'Phlébologie',
            'Allergologie',
        ];

        foreach ($noms as $index => $nom) {
            $specificite = new Specificite();
            $specificite->setName($nom);
            $specificite->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($specificite);
            $this->addReference('specificite_' . $index, $specificite);
        }

        $manager->flush();
    }
}
