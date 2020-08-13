<?php

namespace App\Controller;

use DateTime;
use Symfony\Component\Mime\Email;
use App\Repository\CoiffeurRepository;
use App\Repository\ReservationRepository;
use App\Service\ReservationManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationCreateController extends AbstractController
{
    /**
     * @Route("/reservation/create", name="reservation_create")
     */
    public function reservationCreate(Request $request, CoiffeurRepository $repo, ReservationManager $reservationManager, ReservationRepository $repoReservation, MailerInterface $mailer)
    {
        $user = $this->getUser();
        
        $form = $request->request->all();
        $coiffeur = $repo->find($form["coiffeur"]);
        $username = $coiffeur->getUsername();

        $date = DateTime::createFromFormat('Y-m-d H:i', $form["date"]);
        $dateTime = $date->format('Y/m/d à H:i');

        $allReservation = $repoReservation->findByCoiffeur($coiffeur);
        $aReservation = [];
        foreach ($allReservation as $reservation) {
            $rdv = $reservation->getDateRDV();
            $rdv = $rdv->format('Y-m-d H:i');
            $aReservation[] = $rdv;
        }

        if (in_array($form['date'], $aReservation)) {
            $this->addFlash('fail', "La réservation a échouée, le créneau du $dateTime avec $username est déjà réservé");
            return $this->redirectToRoute('reservation');
        }

        $reservationManager->addReservation($user, $coiffeur, $date);

       /*  $message = (new Email())
        ->from('safouendakhli@workshop-barbershop.fr')
        ->to($user->getEmail())
        ->subject('Réservation')
        ->text(
            "Vous avez rendez-vous le $dateTime avec $username"
            );

        $mailer->send($message); */

        $this->addFlash('success', "Votre réservation est le $dateTime avec $username");
        return $this->redirect('/');
    }
}
