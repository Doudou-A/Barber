<?php

namespace App\Service;

use DateTime;
use DateInterval;
use App\Service\CommonManager;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Collection;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserManager
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager, CommonManager $commonManager, UserRepository $repo, UserPasswordEncoderInterface $encoder)
    {
        $this->commonManager = $commonManager;
        $this->encoder = $encoder;
        $this->manager = $manager;
        $this->repo = $repo;
    }

    public function addUser($user){
        $user->setDateCreated(new \DateTime());
        $token = random_bytes(15);
        $token = bin2hex($token);
        $user->setToken($token);
        $user->setNumberChange(0);

        $hash = $this->encoder->encodePassword($user, $user->getPassword());
        $user->setPassword($hash);

        return $user;
    }

    public function findAllUser()
    {
        $users = $this->repo->findAll();

        foreach ($users as $user) {
            $name = $user->getName();
            $firstName = $user->getFirstName();
            $allUser["$name $firstName"] = $user->getId();
        }

        return $allUser;
    }

    public function delete($reservation){

        $this->commonManager->supprFile($reservation, 'reservations');
        $this->supprSnap($reservation);
        $this->commonManager->remove($reservation);
    }

    public function supprSnap($reservation): void
    {
        $snapName = $reservation->getSnap();
        unlink("uploads/reservations/$snapName");
    }
}