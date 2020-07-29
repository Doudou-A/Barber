<?php

namespace App\Controller;

use DateInterval;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index()
    {
        /* $aDate = [];
        $date = date('l d F');
        $dateRequest = date('Y-m-d');

        $dateFr = strftime("%A %d %B", strtotime($date));

        $hour = new Datetime();
        $minutes_to_add = 30;
        $aHour = [];
        $hour->setTime(10, 00);
        $time = $hour->format('H:i');
        $aHour[] = $hour;
        for ($j = 1; $j <= 18; $j++) {
            $hour->add(new DateInterval('PT' . $minutes_to_add . 'M'));
            $time = $hour->format('H:i');
            $aHour[] = $time;
        }

        $aDateHour = [];

        $aDateHour['dateFr'] = $dateFr;
        $aDateHour['dateData'] = $dateRequest;
        $aDateHour['hour'] = $aHour;
        $aDate[] = $aDateHour; */
        // $date = date('Y-m-d H:i:s');


        /* $hour = new Datetime();
        $aHour = [];
        $hour->setTime(10, 00);
        $time = $hour->format('H:i');

        $minutes_to_add = 30;

        $aHour[] = $time;
        for ($j = 1; $j <= 18; $j++) {
            $hour->add(new DateInterval('PT' . $minutes_to_add . 'M'));
            $time = $hour->format('H:i');
            $aHour[] = $time;
        }

        $dateTestToday = [];
        $dateTestToday[$dateData] = $aHour;
 */
        // $aDate[$dateFrSmall] = [$dateTestToday];
        // $today = $dateFr;

        for ($i = 1; $i <= 30; $i++) {
            if ($i == 1) {
                $aDate = [];
                $date = date('l d F');
                $dateRequest = date('Y-m-d');

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

        return $this->render('reservation/index.html.twig', [
            'aDate' => $aDate,
        ]);
    }
}
