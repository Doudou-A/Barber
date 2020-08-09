<?php

namespace App\Controller;

use App\Repository\CoiffeurRepository;
use DateTime;
use App\Service\CommonManager;
use App\Repository\ReservationRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationDeleteOneController extends AbstractController
{
    /**
     * @Route("/admin/reservation/delete/one/{param}", name="reservation_delete_one")
     */
    public function index($param, ReservationRepository $repoReservation, CoiffeurRepository $repoCoiffeur, CommonManager $commonManager)
    {
        $param = explode('_', $param);
        $coiffeurId = $param[0];

        $dateTime = explode(' ', $param[1]);
        $date = explode('-', $dateTime[0]);
        $time = explode(':', $dateTime[1]);

        $dateTime = new DateTime();
        $dateTime = $dateTime->setDate($date[0], $date[1], $date[2]);
        $dateTime = $dateTime->setTime($time[0], $time[1], 00);
        $dateTime = $dateTime->format('Y-m-d H:i:s');

        $reservation = $repoReservation->findReservationTokken($coiffeurId, $dateTime);
        $commonManager->remove($reservation[0]);

        return $this->redirectToRoute('dashboard');
        // return $this->render('reservation_delete_one/index.html.twig', [
        //     'controller_name' => 'ReservationDeleteOneController',
        // ]);
    }
}
