<?php

namespace App\DataFixtures;

use App\Entity\Syndicat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SyndicatFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {   
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 15; $i++) {
            $syndicat = new Syndicat();
            $syndicat->setNom($faker->company())
                     ->setAcronyme($faker->companySuffix())
                     ->setEmail($faker->companyEmail())
                     ->setTelephone($faker->phoneNumber())
                     ->setBanque($faker->company())
                     ->setSiret($faker->siret)
                     ->setNomAssoDon($faker->company())
                     ->setCreatedAt(new \DateTimeImmutable())
                     ->addAdresse($this->getReference('adresse_' . $faker->numberBetween(1, 9), \App\Entity\Adresse::class))
                     ->addCentrale($this->getReference('centrale_' . $faker->numberBetween(1, 4), \App\Entity\Centrale::class))
                     ->addSecteur($this->getReference('secteur_' . $faker->numberBetween(1, 4), \App\Entity\Secteur::class))
                     ->addActivite($this->getReference('activite_' . $faker->numberBetween(1, 2), \App\Entity\Activite::class))
                     ->addStatut($this->getReference('statut_' . $faker->numberBetween(1, 6), \App\Entity\Statut::class))
                     ->addSpecificite($this->getReference('specificite_' . $faker->numberBetween(1, 5), \App\Entity\Specificite::class));

            $manager->persist($syndicat);
            $this->addReference('syndicat_' . $i, $syndicat);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AdresseFixtures::class,
            CentraleFixtures::class,
            StatutFixtures::class,
            ActiviteFixtures::class,
            SecteurFixtures::class,
            SpecificiteFixtures::class
        ];
    }
}
