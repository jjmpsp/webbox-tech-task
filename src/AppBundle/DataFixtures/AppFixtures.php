<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture implements ORMFixtureInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->createSampleUsers($manager);
        $manager->flush();
    }

    private function createSampleUsers(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $newUser = new User();
            $newUser->setFullName($faker->firstName.' '.$faker->lastName);
            $newUser->setDateOfBirth($faker->dateTimeInInterval($startDate = '-30 years', $interval = '+ 18 years', $timezone = 'Europe/London'));
            $newUser->setUsername($faker->userName);
            $newUser->setEmail($faker->freeEmail);
            $password = $this->encoder->encodePassword($newUser, 'password');
            $newUser->setPassword($password);
            $newUser->setEnabled(true);
            $manager->persist($newUser);
        }
    }
}