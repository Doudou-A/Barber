<?php

namespace App\Controller;

use App\Repository\CoiffeurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CoiffeurRepository $repo)
    {
        $coiffeurs = $repo->findAll();

        return $this->render('home/index.html.twig', [
            'coiffeurs' => $coiffeurs,
        ]);
    }
}
