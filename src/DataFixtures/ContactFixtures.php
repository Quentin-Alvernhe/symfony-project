<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ContactFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 10; $i++) {
            $contact = new Contact();
            $contact->setPrenom($faker->firstName)
                    ->setNom($faker->lastName)
                    ->setCommentaire($faker->sentence)
                    ->setEmailPro($faker->unique()->companyEmail)
                    ->setEmailPerso($faker->unique()->freeEmail)
                    ->setTelephonePortablePro($faker->phoneNumber)
                    ->setTelephonePortablePerso($faker->phoneNumber)
                    ->setSiret($faker->siret)
                    ->setNombreSalarie($faker->numberBetween(0, 100))
                    ->setRpps($faker->numerify('##########'))
                    ->setDateRetraite($faker->optional()->dateTimeBetween('-10 years', 'now'))
                    ->setAnneeInstallation($faker->optional()->dateTimeBetween('-20 years', 'now'))
                    ->setCentrale($this->getReference('centrale_' . $faker->numberBetween(1, 2), \App\Entity\Centrale::class))
                    ->setSecteur($this->getReference('secteur_' . $faker->numberBetween(1, 4), \App\Entity\Secteur::class))
                    ->addAdresse($this->getReference('adresse_' . $faker->numberBetween(1, 10), \App\Entity\Adresse::class))
                    ->addSyndicat($this->getReference('syndicat_' . $faker->numberBetween(1,10), \App\Entity\Syndicat::class))
                    ->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($contact);
            $this->addReference('contact_' . $i, $contact);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CentraleFixtures::class,
            SecteurFixtures::class,
            AdresseFixtures::class, 
            SyndicatFixtures::class,
        ];
    }
}
