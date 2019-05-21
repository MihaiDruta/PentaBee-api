<?php

namespace App\DataFixtures;

use App\Entity\Technology;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TechnologyFixtures extends Fixture
{
    public const TECHNOLOGIES = [
        'PHP' => 'Backend language.',
        'JavaScript' => 'Language to make everything trashy.',
        'Node.js' => 'Backend'
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::TECHNOLOGIES as $name => $description) {
            $technology = new Technology();
            $technology->setName($name);
            $technology->setDescription($description);
            $technology->setCreatedAt(new DateTime());
            $technology->setUpdatedAt(new DateTime());
            $manager->persist($technology);

            $this->setReference('tech_' . $name, $technology);
        }

        $manager->flush();
    }
}
