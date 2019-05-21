<?php

namespace App\DataFixtures;

use App\Entity\Technology;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public const POSITIONS = [
        'dev',
        'po',
        'qa'
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $user = new User();
        $user->setUsername('ADMIN');
        $user->setPassword('iamadmin');
        $user->setPosition(self::POSITIONS[rand(0, 2)]);
        $user->setSeniority(1);
        $user->setName('Staci');
        $user->setSurname('Nicolae');
        $user->setCreatedAt(new DateTime());
        $user->setUpdatedAt(new DateTime());
        $manager->persist($user);

        $user = new User();
        $user->setUsername('USER');
        $user->setPassword('passtester');
        $user->setPosition(self::POSITIONS[rand(0, 2)]);
        $user->setSeniority(1);
        $user->setName('Druta');
        $user->setSurname('Mihai');
        $user->setCreatedAt(new DateTime());
        $user->setUpdatedAt(new DateTime());
        $manager->persist($user);

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setUsername($faker->userName);
            $user->setPassword($faker->password);
            $user->setPosition(self::POSITIONS[rand(0, 2)]);
            $user->setSeniority(mt_rand(0, 2));
            $user->setName($faker->firstName);
            $user->setSurname($faker->lastName);
            $user->setCreatedAt(new DateTime());
            $user->setUpdatedAt(new DateTime());
            $this->setReference('user_' . $i, $user);

            /** @var Technology $technology */
            $technology = $this->getReference('tech_' . array_rand(TechnologyFixtures::TECHNOLOGIES));
            $user->addTechnology($technology);
            $manager->persist($user);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return array(
            TechnologyFixtures::class,
        );
    }
}
