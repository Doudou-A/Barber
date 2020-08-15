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
        $fileName = $coiffeur->getFile();
        unlink($this->getParameter('%kernel.project_dir%/public/uploads/coiffeurs/$fileName'));
        $fileName = $coiffeur->getSnap();
        unlink($this->getParameter('%kernel.project_dir%/public/uploads/coiffeurs/$fileName'));
        $coiffeurManager->delete($coiffeur);
        
        return $this->redirectToRoute('home');
    }
}
