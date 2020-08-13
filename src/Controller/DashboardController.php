<?php

namespace App\Controller;

use App\Service\ReservationManager;
use App\Repository\CoiffeurRepository;
use App\Repository\ReservationRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    /**
     * @Route("/admin/dashboard", name="dashboard")
     */
    public function index(CoiffeurRepository $repoCoiffeur, ReservationRepository $repoReservation, ReservationManager $reservationManager)
    {
        $aCoiffeur = $repoCoiffeur->findAll();

        $aReservation = $repoReservation->findAll();
        $now = $reservationManager->getNow('Y-m');
        // $now = $now->format('Y-m');

        $aDate = [];
        foreach($aReservation as $reservation){
            $date = $reservation->getDateRDV();
            $dateData = $date->format('Y-m');
            $date = $date->format('M Y');
            setlocale(LC_TIME, "fr_FR");
            $dateFr = strftime("%B %Y", strtotime($date));
            $dateFr = ucfirst($dateFr);
            if($dateData < $now) $aDate[$dateFr][$dateData][] = $dateData;
            // $aDate[$dateFr][$dateData][] = $dateData;
        }

        // dd($aDate);

        return $this->render('dashboard/index.html.twig', [
            'aCoiffeur' => $aCoiffeur,
            'aDate' => $aDate,
        ]);
    }
}
