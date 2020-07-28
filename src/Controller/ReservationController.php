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
        $aDate = [];
        $date = date('l d F');

        setlocale(LC_TIME, "fr_FR");
        $dateFr = strftime("%A %d %B", strtotime($date));
        
        // $aDate[] = $dateFr;
        $today = $dateFr;

        for ($i = 1; $i <= 30; $i++) {
            $date = date('l d F', strtotime($date . ' +1 day'));
            $dateFr = strftime("%A %d %B", strtotime($date));
            
            $aDate[] = $dateFr;
        }
        
        $hour = new Datetime();
        // dd($hour);
        // $hours_to_add = 2;
        $hour->add(new DateInterval('PT4H'));
        $todayTime = $hour->format('H');
        $hour->setTime($todayTime, 30);
        
        $hourMin = new DateTime();
        $hourMin->setTime(10, 00);
        
        if($hour < $hourMin){
            $hour->setTime(11, 30);
            $todayTime = $hour->format('H:i');
        } 

        $aHour = [];
        $hour->setTime(10, 00);
        $time = $hour->format('H:i');

        $aHour[] = $time;
        
        $minutes_to_add = 30;
        for ($j = 1; $j <= 18; $j++){
            $hour->add(new DateInterval('PT' . $minutes_to_add . 'M'));
            $time = $hour->format('H:i');
            $aHour[] = $time;
        }


        return $this->render('reservation/index.html.twig', [
            'aDate' => $aDate,
            'today' => $today,
            'aHour' => $aHour,
            'todayTime' => $todayTime,
        ]);
    }
}
