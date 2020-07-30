<?php

namespace App\Controller;

use DateInterval;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ReservationShowController extends AbstractController
{
    /**
     * @Route("/Reservation-Show", name="reservation_show")
     */
    public function reservationShow()
    {
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
                $aHour[] = $time;
                for ($j = 1; $j <= 18; $j++) {
                    $hour->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                    $time = $hour->format('H:i');
                    $aHour[] = $time;
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
            $aHour[] = $time;
            for ($j = 1; $j <= 18; $j++) {
                $hour->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                $time = $hour->format('H:i');
                $aHour[] = $time;
            }

            $aDateHour = [];

            $aDateHour['dateFr'] = $dateFr;
            $aDateHour['dateData'] = $dateRequest;
            $aDateHour['hour'] = $aHour;
            $aDate[] = $aDateHour;
        }

        // dd($aDate);

        return $this->render('reservation/reservationShow.html.twig', [
            'aDate' => $aDate,
        ]);
    }
}
