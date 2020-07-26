<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PresentationCreateController extends AbstractController
{
    /**
     * @Route("/coiffure", name="coiffure")
     */
    public function index()
    {
        return $this->render('coiffure/index.html.twig', [
            'controller_name' => 'CoiffureController',
        ]);
    }
}
