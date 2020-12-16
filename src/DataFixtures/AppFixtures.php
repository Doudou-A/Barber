<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     *
     * @var UserPasswordEncoderInterface
     *
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin')
            ->setEmail('admin@gmail.com')
            ->setPassword($this->encoder->encodePassword($user, 'password'))
            ->setRoles(['ROLE_ADMIN'])
            ->setName('admin')
            ->setFirstName('admin')
            ->setDateCreated(date())
            ->setNumber(1);

        $manager->persist($user);

        $user->setUsername('user')
            ->setEmail('user@gmail.com')
            ->setPassword($this->encoder->encodePassword($user, 'password'))
            ->setRoles(['ROLE_USER'])
            ->setName('user')
            ->setFirstName('user')
            ->setDateCreated(date())
            ->setNumber(2);

        $manager->persist($user);

        $manager->flush();
    }
}
