<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use App\Service\CommonManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ReservationDeleteClientController extends AbstractController
{
    /**
     * @Route("/reservation/delete/{id}", name="reservation_delete_client", methods={"DELETE"})
     */
    public function index(Reservation $id, EntityManagerInterface $manager)
    {
        $manager->remove($id);
        $manager->flush();

        $this->addFlash('success', 'Vous avez annulé votre rendez-vous');

        return $this->redirectToRoute('reservation');
    }
}
