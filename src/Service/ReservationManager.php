<?php

namespace App\Service;

use DateTime;
use DateInterval;
use App\Service\CommonManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Collection;
use phpDocumentor\Reflection\Types\Integer;

class ReservationManager
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager, CommonManager $commonManager)
    {
        $this->manager = $manager;
        $this->commonManager = $commonManager;
    }

    public function getNow(){
        $hours_to_add = 2;
        $now = new Datetime();
        return $now->add(new DateInterval('PT' . $hours_to_add . 'H'));
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
