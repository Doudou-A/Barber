<?php

namespace App\Controller;

use App\Repository\CoiffeurRepository;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationAdminUserController extends AbstractController
{
    /**
     * @Route("/admin/reservation/user/{data}", name="reservation_admin_user")
     */
    public function index($data, Request $request, CoiffeurRepository $repoCoiffeur, ReservationRepository $repoReservation)
    {
        $data = explode('_', $data);

        $coiffeur = $data[0];
        $date = $data[1];
        $dateRDV = $repoReservation->findReservationTokken($coiffeur, $date);
        if(!$dateRDV) $dateRDV = 'ok';
        else{
            $dateRDV = $dateRDV[0];
            $user = $dateRDV->getUser();
        }

        return new JsonResponse([
            'html' => $this->renderView('reservation/reservationAdminShow.html.twig', [
                'user' => $user,
            ])
        ]);
    }
}
