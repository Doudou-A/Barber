<?php

namespace App\Controller;

use App\Repository\CoiffeurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index(CoiffeurRepository $repo)
    {

        $aCoiffeur = $repo->findAll();

        return $this->render('reservation/index.html.twig', [
            'aCoiffeur' => $aCoiffeur,
        ]);
    }
}
