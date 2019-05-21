<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use App\Entity\Technology;
use App\Entity\Type;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ActivityFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $activity = new Activity();
            $activity->setName($faker->jobTitle);
            $activity->setDescription($faker->sentence);
            $activity->setApplicationDeadline($faker->dateTimeInInterval('now', '+10 days'));
            $activity->setFinalDeadline($faker->dateTimeInInterval('+10 days', '+30 days'));
            $activity->setStatus($faker->randomElement(Activity::getAllStatuses()));
            $activity->setCreatedAt(new DateTime());
            $activity->setUpdatedAt(new DateTime());

            /** @var User $owner */
            $owner = $this->getReference('user_' . rand(3, 6));
            $activity->setOwner($owner);

            /** @var Type $type */
            $type = $this->getReference('type_' . TypeFixtures::TYPES[rand(0, 2)]);
            $activity->addType($type);

            /** @var Technology $technology */
            $technology = $this->getReference('tech_' . array_rand(TechnologyFixtures::TECHNOLOGIES));
            $activity->addTechnology($technology);
            $manager->persist($activity);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return array(
            UserFixtures::class,
        );
    }
}
