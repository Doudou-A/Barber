<?php

namespace App\Controller;

use DateTime;
use DateInterval;
use App\Repository\CoiffeurRepository;
use App\Repository\ReservationRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CalendarController extends AbstractController
{
    /**
     * @Route("/admin/Calendar-Show/{date}", name="calendar")
     */
    public function index($date, CoiffeurRepository $repoCoiffeur, ReservationRepository $repoReserv)
    {   
        $allCoiffeur = $repoCoiffeur->findAll();

        $aCoiffeur = [];
        foreach ($allCoiffeur as $coiffeur) {
            $username = strtoupper(substr($coiffeur->getUsername(), 0, 3));
            $aReservation = $repoReserv->findReservationTokkenDay($coiffeur->getId(), $date);
            $aCoiffeur[$username]['reservations'] = null;
            foreach($aReservation as $reservation){
                $rdv = $reservation->getDateRDV();
                $dateTime = $rdv->format('Y-m-d H:i');
                $aCoiffeur[$username]['reservations'][] = $dateTime;
            }
            $aCoiffeur[$username]['id'] = $coiffeur->getId();
        }
        // dd($aCoiffeur);
        $hour = new Datetime();
        $minutes_to_add = 30;
        $aDateHour = [];
        $hour->setTime(10, 00);
        $time = $hour->format('H:i');
        $aDateHour["$date $time"] = $time;
        for ($j = 1; $j <= 18; $j++) {
            $hour->add(new DateInterval('PT' . $minutes_to_add . 'M'));
            $time = $hour->format('H:i');
            $aDateHour["$date $time"] = $time;
        }
        
        $date = explode('-', $date);
        
        $dateFR = new DateTime();
        $dateFR = $dateFR->setDate($date[0], $date[1], $date[2]);
        setlocale(LC_TIME, "fr_FR.utf8");
        $dateFR = strftime("%A %d %B", strtotime("$date[0]-$date[1]-$date[2]"));

        return new JsonResponse([
            'html' => $this->renderView('calendar/index.html.twig', [
                'aCoiffeur' => $aCoiffeur,
                'aDateHour' => $aDateHour,
                'dateFR' => $dateFR,
            ])
        ]);
    }
}
