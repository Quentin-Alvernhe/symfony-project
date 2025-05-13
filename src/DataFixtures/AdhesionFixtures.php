<?php

namespace App\DataFixtures;

use App\Entity\Adhesion;
use App\Entity\Contact;
use App\Entity\Cotisation;
use App\Entity\Periode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AdhesionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $totalCotisations = 5;

        for ($i = 0; $i < 10; $i++) {
            /** @var Contact $contact */
            $contact = $this->getReference("contact_" . $faker->numberBetween(1, 9), \App\Entity\Contact::class);;
            /** @var Periode $periode */
            $periode = $this->getReference("periode_" . random_int(2024, 2026), \App\Entity\Periode::class);
            /** @var Cotisation $cotisation */
            $cotisation = $this->getReference("cotisation_" . $faker->numberBetween(0, $totalCotisations - 1), \App\Entity\Cotisation::class);

            $adhesion = new Adhesion();
            $adhesion->setContact($contact);
            $adhesion->setPeriode($periode);
            $adhesion->setCotisation($cotisation);
            $adhesion->setCreatedAt(new \DateTimeImmutable());

            $this->addReference("adhesion_$i", $adhesion);
            $manager->persist($adhesion);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ContactFixtures::class,
            PeriodeFixtures::class,
            CotisationFixtures::class,
        ];
    }
}
