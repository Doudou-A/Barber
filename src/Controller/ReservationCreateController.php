<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Service\CommonManager;
use App\Repository\CoiffeurRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationCreateController extends AbstractController
{
    /**
     * @Route("/reservation/create", name="reservation_create")
     */
    public function reservationCreate(Request $request, CoiffeurRepository $repo, CommonManager $commonManager)
    {
        $user = $this->getUser();
        $form = $request->request->all();
        $coiffeur = $repo->find($form["coiffeur"]);

        $reservation = new Reservation;
        $date = DateTime::createFromFormat('Y-m-d H:i' , $form["date"]);
        // $date->setTime($form["date"]);

        $reservation->setUser($user);
        $reservation->setCoiffeur($coiffeur);
        $reservation->setDateRDV($date);

        $commonManager->persist($reservation);

        return new JsonResponse($reservation);
    }
}
