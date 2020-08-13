<?php

namespace App\Controller;

use App\Repository\ReservationRepository;
use App\Service\CommonManager;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ReservationDeleteController extends AbstractController
{
    /**
     * @Route("/admin/reservation/delete/{date}", name="reservation_delete")
     */
    public function index($date, ReservationRepository $repo, CommonManager $commonManager)
    {

        $date = explode('-', $date);
        
        $dateTimeLast = new DateTime();
        $dateTimeLast = $dateTimeLast->setDate($date[0], $date[1], 31);
        $dateTimeLast = $dateTimeLast->setTime(23, 59, 00);
        $dateTimeLast = $dateTimeLast->format('Y-m-d H:i:s');
        
        $dateTimeFirst = new DateTime();
        $dateTimeFirst = $dateTimeFirst->setDate($date[0], $date[1], 1);
        $dateTimeFirst = $dateTimeFirst->setTime(00, 01, 00);
        $dateTimeFirst = $dateTimeFirst->format('Y-m-d H:i:s');

        $reservations = $repo->findMonth($dateTimeFirst, $dateTimeLast);

        if($reservations){
            foreach($reservations as $reservation){
                $commonManager->remove($reservation);
            }

            $this->addFlash('success', 'Ces réservations ont été supprimées');
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('reservation_delete/index.html.twig', [
            'controller_name' => 'ReservationDeleteController',
        ]);
    }
}
