<?php

namespace App\Controller;

use App\Service\IndisponibiliteManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoiffeurIndispoController extends AbstractController
{
    /**
     * @Route("/coiffeur/indispo/{param}", name="coiffeur_indispo")
     */
    public function index($param, IndisponibiliteManager $manager)
    {
        $manager->create($param);

        return $this->redirectToRoute('dashboard');
    }
}
