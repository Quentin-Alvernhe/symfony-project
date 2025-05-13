<?php

namespace App\DataFixtures;

use App\Entity\Cotisation;
use App\Entity\Syndicat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CotisationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $labels = ['Tarif normal', 'Tarif réduit', 'Tarif étudiant', 'Tarif retraité'];
        $refIndex = 0;

        
        for ($i = 0; $i < 5; $i++) {
            /** @var Syndicat $syndicat */
            $syndicat = $this->getReference("syndicat_" . $i +1, \App\Entity\Syndicat::class);
            $num = rand(1, 3);

            for ($j = 0; $j < $num; $j++) {
                $cotisation = new Cotisation();
                $cotisation->setNom($faker->randomElement($labels));
                $cotisation->setMontant($faker->randomFloat(120, 160, 200));
                $cotisation->setSyndicat($syndicat);
                $cotisation->setCreatedAt(new \DateTimeImmutable());
                $ref = "cotisation_{$refIndex}";
                $this->addReference($ref, $cotisation);
                $refIndex++;
                $manager->persist($cotisation);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SyndicatFixtures::class,
        ];
    }
}

