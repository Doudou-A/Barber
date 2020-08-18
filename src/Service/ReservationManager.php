<?php

namespace App\Service;

use DateTime;
use DateInterval;
use App\Entity\Reservation;
use App\Repository\ReservationRepository;
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

    public function __construct(EntityManagerInterface $manager, ReservationRepository $repo, CommonManager $commonManager)
    {
        $this->commonManager = $commonManager;
        $this->manager = $manager;
        $this->repo = $repo;
    }

    public function addReservation($user, $coiffeur, $date){
        $reservation = new Reservation;
        // $date->setTime($form["date"]);

        $reservation->setUser($user);
        $reservation->setCoiffeur($coiffeur);
        $reservation->setDateRDV($date);

        $this->commonManager->persist($reservation);
    }

    public function getADate(){
        for ($i = 1; $i <= 30; $i++) {
            if ($i == 1) {
                $aDate = [];
                $date = date('l d F');
                $dateRequest = date('Y-m-d');

                setlocale(LC_TIME, "fr_FR.utf8");
                $dateFr = strftime("%A %d %B", strtotime($date));

                $hour = new Datetime();
                $minutes_to_add = 30;
                $aHour = [];
                $hour->setTime(10, 00);
                $time = $hour->format('H:i');
                $aHour["$dateRequest $time"] = $time;
                for ($j = 1; $j <= 18; $j++) {
                    $hour->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                    $time = $hour->format('H:i');
                    $aHour["$dateRequest $time"] = $time;
                }

                $aDateHour = [];

                $aDateHour['dateFr'] = $dateFr;
                $aDateHour['dateData'] = $dateRequest;
                $aDateHour['hour'] = $aHour;
                $aDate[] = $aDateHour;
            }
            $date = date('l d F', strtotime($date . '+1 day'));
            $dateRequest = date('Y-m-d', strtotime($dateRequest . '+1 day'));

            $dateFr = strftime("%A %d %B", strtotime($date));

            $aHour = [];
            $hour->setTime(10, 00);
            $time = $hour->format('H:i');
            $aHour["$dateRequest $time"] = $time;
            for ($j = 1; $j <= 17; $j++) {
                $hour->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                $time = $hour->format('H:i');
                $aHour["$dateRequest $time"] = $time;
            }

            $aDateHour = [];

            $aDateHour['dateFr'] = $dateFr;
            $aDateHour['dateData'] = $dateRequest;
            $aDateHour['hour'] = $aHour;
            $aDate[] = $aDateHour;
        }

        return $aDate;
    }

    public function getReservations($coiffeur){
        $reservationCoiffeur = $this->repo->findByCoiffeur($coiffeur->getId());
        $reservations = [];
        foreach ($reservationCoiffeur as $reservationTaked) {
            $dateRDV = $reservationTaked->getDateRDV();
            $dayRDV = $dateRDV->format('Y-m-d');
            $hourRDV = $dateRDV->format('H:i');
            $reservations[] = "$dayRDV $hourRDV";
        }

        return $reservations;
    }

    public function getNow($format){
        $hours_to_add = 2;
        $now = new Datetime();
        $now->add(new DateInterval('PT' . $hours_to_add . 'H'));

        return $now->format($format);
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
