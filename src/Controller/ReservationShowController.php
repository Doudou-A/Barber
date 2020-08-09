<?php

namespace App\Controller;

use DateTime;
use DateInterval;
use App\Entity\Coiffeur;
use App\Repository\ReservationRepository;
use App\Service\ReservationManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\Date;

class ReservationShowController extends AbstractController
{
    /**
     * @Route("/Reservation-Show/{id}", name="reservation_show")
     */
    public function reservationShow(Coiffeur $coiffeur, ReservationRepository $repo, ReservationManager $reservationManager)
    {
        
        $today = date('Y-m-d');
        $now = $reservationManager->getNow();

        $lastHour = new DateTime();
        $lastHour->setTime(17, 00);
        
        $timeReservation = new Datetime();
        $hours_to_add = 4;
        $timeReservation->add(new DateInterval('PT' . $hours_to_add . 'H'));
        $timeReservation = $timeReservation->format('H:i');

        $reservationCoiffeur = $repo->findByCoiffeur($coiffeur->getId());
        $reservations = [];
        foreach ($reservationCoiffeur as $reservationTaked) {
            $dateRDV = $reservationTaked->getDateRDV();
            $dayRDV = $dateRDV->format('Y-m-d');
            $hourRDV = $dateRDV->format('H:i');
            $reservations[] = "$dayRDV $hourRDV";
        }

        for ($i = 1; $i <= 30; $i++) {
            if ($i == 1) {
                $aDate = [];
                $date = date('l d F');
                $dateRequest = date('Y-m-d');

                setlocale(LC_TIME, "fr_FR");
                $dateFr = strftime("%A %d %B", strtotime($date));

                $hour = new Datetime();
                $minutes_to_add = 30;
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

        // dd($aDate);
        return new JsonResponse([
            'html' => $this->renderView('reservation/reservationShow.html.twig', [
                'aDate' => $aDate,
                'coiffeur' => $coiffeur,
                'today' => $today,
                'now' => $now,
                'lastHour' => $lastHour,
                'timeReservation' => $timeReservation,
                'reservations' => $reservations,
            ])
        ]);
    }
}
