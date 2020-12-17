<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTime;
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
        $user->setEmail('admin@gmail.com')
            ->setPassword($this->encoder->encodePassword($user, 'password'))
            ->setRoles(['ROLE_ADMIN'])
            ->setName('admin')
            ->setFirstName('admin')
            ->setDateCreated(new DateTime())
            ->setNumber(1)
            ->setToken(null)
            ->setNumberChange(null);

        $manager->persist($user);

        $user = new User();
        $user->setEmail('user@gmail.com')
            ->setPassword($this->encoder->encodePassword($user, 'password'))
            ->setRoles(['ROLE_USER'])
            ->setName('user')
            ->setFirstName('user')
            ->setDateCreated(new DateTime())
            ->setNumber(2)
            ->setToken(null)
            ->setNumberChange(null);

        $manager->persist($user);

        $manager->flush();
    }
}
