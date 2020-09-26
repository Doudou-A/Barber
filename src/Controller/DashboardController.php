<?php

namespace App\Controller;

use DateTime;
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
        // $aCoiffeur = $repoCoiffeur->findAll();

        $aReservation = $repoReservation->findAll();
        $now = $reservationManager->getNow('Y-m');
        // $now = $now->format('Y-m');

        $aDate = [];
        foreach ($aReservation as $reservation) {
            $date = $reservation->getDateRDV();
            $dateData = $date->format('Y-m');
            $date = $date->format('M Y');
            setlocale(LC_TIME, "fr_FR.utf8");
            $dateFr = strftime("%B %Y", strtotime($date));
            $dateFr = ucfirst($dateFr);
            if ($dateData < $now) $aDate[$dateFr][$dateData][] = $dateData;
            // $aDate[$dateFr][$dateData][] = $dateData;
        }

        $date = date('l d F');
        $dateRequest = date('Y-m-d');
        for ($i = 1; $i <= 30; $i++) {

            setlocale(LC_TIME, "fr_FR.utf8");
            $dateFr = [];
            $dateFrDay = strftime("%d", strtotime($date));
            $dateFrMonth = strftime("%A", strtotime($date));
            $dateFrYear = strftime("%b", strtotime($date));
            $dateFr[] = $dateFrDay;
            $dateFr[] = $dateFrMonth;
            $dateFr[] = $dateFrYear;

            $aDateHour = [];

            $aDateHour['dateFr'] = $dateFr;
            $aDateHour['dateData'] = $dateRequest;
            $aCalendar[] = $aDateHour;

            $date = date('l d F', strtotime($date . '+1 day'));
            $dateRequest = date('Y-m-d', strtotime($dateRequest . '+1 day'));
        }


        return $this->render('dashboard/index.html.twig', [
            // 'aCoiffeur' => $aCoiffeur,
            'aDate' => $aDate,
            'aCalendar' => $aCalendar,
        ]);
    }
}
