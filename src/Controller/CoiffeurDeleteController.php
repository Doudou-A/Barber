<?php

namespace App\Controller;

use App\Entity\Coiffeur;
use App\Service\CoiffeurManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoiffeurDeleteController extends AbstractController
{
    /**
     * @Route("/coiffeur/{id}/delete", name="coiffeur_delete")
     */
    public function index(Coiffeur $coiffeur, CoiffeurManager $coiffeurManager)
    {
        $coiffeurManager->delete($coiffeur);
        
        return $this->redirectToRoute('home');
    }
}
