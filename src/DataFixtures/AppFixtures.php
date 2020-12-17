<?php

namespace App\DataFixtures;

use App\Entity\Coiffeur;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
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
        $faker = Factory::create();

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

        for($i = 0; $i <10; $i++){
            $user = new User();
            $user->setEmail($faker->email)
                ->setPassword($this->encoder->encodePassword($user, 'password'))
                ->setRoles(['ROLE_USER'])
                ->setName($faker->name)
                ->setFirstName($faker->firstName)
                ->setDateCreated($faker->dateTime)
                ->setNumber($faker->phoneNumber)
                ->setToken($faker->randomAscii)
                ->setNumberChange(null);

            $manager->persist($user);
        }

        for($i = 0; $i < 4; $i++){
            $coiffeur = new Coiffeur();
            $coiffeur->setUsername($faker->userName)
                ->setFile($faker->image(__DIR__.'/../public/img/barber.png', 'barber.jpg', 300, 300, "barber"))
                ->setSnap($faker->image(__DIR__.'/../public/img/barber.png', 'barber.jpg', 300, 300, "barber"))
                ->setFacebook($faker->url)
                ->setInsta($faker->url);

            $manager->persist($coiffeur);
        }
        $manager->flush();
    }
}
