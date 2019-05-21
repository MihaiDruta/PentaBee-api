<?php

namespace App\DataFixtures;

use App\Entity\Type;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class TypeFixtures extends Fixture
{
    public const TYPES = [
        'dt estimation',
        'dt audit',
        'kss session'
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        foreach (self::TYPES as $typeName) {
            $type = new Type();
            $type->setName($typeName);
            $type->setDescription($faker->sentence);
            $type->setCreatedAt(new DateTime());
            $type->setUpdatedAt(new DateTime());
            $manager->persist($type);
            $this->setReference('type_' . $typeName, $type);
        }
        $manager->flush();
    }
}
