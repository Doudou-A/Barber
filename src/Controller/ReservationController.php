<?php

namespace App\Controller;

use App\Repository\CoiffeurRepository;
use App\Repository\ReservationRepository;
use App\Service\ReservationManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index(CoiffeurRepository $repoCoiffeur, ReservationRepository $repoReservation, ReservationManager $reservationManager)
    {

        $aCoiffeur = $repoCoiffeur->findAll();

        $user = $this->getUser();
        $reservations = $repoReservation->findByUser($user);
        $now = $reservationManager->getNow('Y/m');

        $dateRdv = [];
        foreach($reservations as $reservation){
            $coiffeur = $reservation->getCoiffeur()->getUsername();
            $reservation = $reservation->getDateRDV();
            if($now < $reservation) $dateRdv[$coiffeur] = $reservation->format('d/m/Y H:i');
        }

        return $this->render('reservation/index.html.twig', [
            'aCoiffeur' => $aCoiffeur,
            'dateRdv' => $dateRdv,
            // 'now' => $now,
        ]);
    }
}
