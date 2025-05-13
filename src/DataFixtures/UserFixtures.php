<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

       
        $roleGomed = $this->getReference('role_gomed', \App\Entity\Role::class);
        $roleSyndicat = $this->getReference('role_syndicat', \App\Entity\Role::class);

        $roles = [$roleGomed, $roleSyndicat];

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $hashedPassword = $this->hasher->hashPassword($user, 'password123');
            $user->setEmail($faker->unique()->email())
                ->setPassword($hashedPassword)
                ->setPrenom($faker->firstName())
                ->setNom($faker->lastName())
                ->setActive($faker->boolean())
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdatedAt(new \DateTime())
                ->setRole($faker->randomElement($roles))
                ->addSyndicat($this->getReference('syndicat_' . $faker->numberBetween(1, 10), \App\Entity\Syndicat::class));

            $manager->persist($user);
            $this->addReference('utilisateur_' . $i, $user);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            RoleFixtures::class,
            SyndicatFixtures::class,
        ];
    }
}
