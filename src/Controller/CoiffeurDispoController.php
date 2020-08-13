<?php

namespace App\Controller;

use App\Service\IndisponibiliteManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoiffeurDispoController extends AbstractController
{
    /**
     * @Route("/coiffeur/dispo/{param}", name="coiffeur_dispo")
     */
    public function index($param, IndisponibiliteManager $manager)
    {
        $manager->delete($param);

        return $this->redirectToRoute('dashboard');
    }
}
