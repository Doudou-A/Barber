<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use Symfony\Component\Mime\Email;
use App\Service\ReservationManager;
use App\Repository\CoiffeurRepository;
use App\Repository\ReservationRepository;
use App\Service\CommonManager;
use App\Service\UserManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationCreateAdminController extends AbstractController
{
    /**
     * @Route("/reservation/create/admin", name="reservation_create_admin")
     */
    public function reservationCreateAdmin(Request $request, CoiffeurRepository $repo, ReservationManager $reservationManager, ReservationRepository $repoReservation, UserManager $userManager,CommonManager $commonManager, MailerInterface $mailer)
    {
        $form = $request->request->all();

        $user = new User();
        $mail = random_bytes(5);
        $user->setEmail(bin2hex($mail));
        $user->setPassword("password");
        $user->setName('name');
        $user->setFirstName($form['firstName']);
        $user->setNumber(0000000000);
        
        $userManager->addUser($user);
        $commonManager->persist($user);

        $coiffeur = $repo->find($form["coiffeur"]);
        $username = $coiffeur->getUsername();

        // $formDate = explode("_", $form["date"]); //ADO Final 
        // $date = DateTime::createFromFormat('Y-m-d H:i', $formDate[0]."_".$formDate[1]);

        $date = DateTime::createFromFormat('Y-m-d H:i', $form["date"]);
        $dateTime = $date->format('d/m/Y à H:i');

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
        return $this->redirect('/index.php');
    }
}
