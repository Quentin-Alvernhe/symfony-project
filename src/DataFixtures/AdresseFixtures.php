<?php

namespace App\DataFixtures;

use App\Entity\Adresse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AdresseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 10; $i++) {
            $adresse = new Adresse();
            $adresse->setLigne1($faker->streetName())
                    ->setCodePostal($faker->postcode())
                    ->setVille($faker->city())
                    ->setPays($faker->country())
                    ->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($adresse);
            $this->addReference('adresse_' . $i, $adresse);
        }

        $manager->flush();
    }
}
