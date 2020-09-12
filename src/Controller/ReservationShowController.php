<?php

namespace App\Controller;

use DateTime;
use DateInterval;
use App\Entity\Coiffeur;
use App\Service\ReservationManager;
use App\Service\IndisponibiliteManager;
use App\Repository\ReservationRepository;
use App\Repository\IndisponibiliteRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationShowController extends AbstractController
{
    /**
     * @Route("/Reservation-Show/{id}", name="reservation_show")
     */
    public function reservationShow(Coiffeur $coiffeur, ReservationRepository $repo, ReservationManager $reservationManager, IndisponibiliteManager $indispoManager)
    {
        
        $today = date('Y-m-d');
        // $now = $reservationManager->getNow(('Y-m'));

        // $lastHour = new DateTime();
        // $lastHour->setTime(17, 00);

        // $timeReservation = new Datetime();
        // $hours_to_add = 4;
        // $timeReservation->add(new DateInterval('PT' . $hours_to_add . 'H'));
        // $timeReservation = $timeReservation->format('H:i');

        $reservations = $reservationManager->getReservations($coiffeur, $today);

        $aDate = $reservationManager->getADate();
        
        $indispos = $indispoManager->getAIndispo($coiffeur);

        // dd($aDate);
        // dd($reservations);
        return new JsonResponse([
            'html' => $this->renderView('reservation/reservationShow.html.twig', [
                'today' => $today,
                'coiffeur' => $coiffeur,
                'reservations' => $reservations,
                'aDate' => $aDate,
                'indispos' => $indispos,
            ])
        ]);
    }
}
