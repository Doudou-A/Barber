<?php

namespace App\Controller;

use DateTime;
use App\Entity\Reservation;
use App\Service\CommonManager;
use App\Repository\CoiffeurRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\ReservationController;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationCreateController extends AbstractController
{
    /**
     * @Route("/reservation/create", name="reservation_create")
     */
    public function reservationCreate(Request $request, CoiffeurRepository $repo, CommonManager $commonManager, ReservationRepository $repoReservation)
    {
        $user = $this->getUser();
        $form = $request->request->all();
        $coiffeur = $repo->find($form["coiffeur"]);
        $username = $coiffeur->getusername();
        
        $date = DateTime::createFromFormat('Y-m-d H:i' , $form["date"]);
        $dateTime = $date->format('Y/m/d à H:i');

        $allReservation = $repoReservation->findByCoiffeur($coiffeur);
        $aReservation = [];
        foreach($allReservation as $reservation){
            $rdv = $reservation->getDateRDV();
            $rdv = $rdv->format('Y-m-d H:i');
            $aReservation[] = $rdv;
        }

        if(in_array($form['date'], $aReservation)){
            $this->addFlash('fail', "La réservation a échouée, le créneau du $dateTime avec $username est déjà réservé");
            return $this->redirectToRoute('reservation');
        }

        $reservation = new Reservation;
        // $date->setTime($form["date"]);

        $reservation->setUser($user);
        $reservation->setCoiffeur($coiffeur);
        $reservation->setDateRDV($date);

        $commonManager->persist($reservation);

        $this->addFlash('success', "Votre réservation est le $dateTime avec $username");

        return $this->redirect('/');
    }
}
